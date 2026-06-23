<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    private function snapBaseUrl()
    {
        return config('services.midtrans.is_production')
            ? 'https://app.midtrans.com'
            : 'https://app.sandbox.midtrans.com';
    }

    public function pay(Request $request, $id)
    {
        $order = OrderModel::with('details.product', 'user')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($order->status !== 'pending') {
            Session::flash('error', 'Pesanan ini tidak dapat dibayar');
            return redirect('/orders/' . $order->id);
        }

        $serverKey = config('services.midtrans.server_key');
        if (empty($serverKey)) {
            Session::flash('error', 'Pembayaran belum dikonfigurasi. Hubungi admin (MIDTRANS_SERVER_KEY belum diisi).');
            return redirect('/orders/' . $order->id);
        }

        // order_id unik tiap percobaan bayar untuk menghindari konflik di Midtrans
        $midtransOrderId = 'HEMA-' . $order->id . '-' . time();

        $items = [];
        foreach ($order->details as $detail) {
            $items[] = [
                'id' => (string) $detail->product_id,
                'price' => (int) round($detail->price),
                'quantity' => (int) $detail->quantity,
                'name' => substr((optional($detail->product)->name ?? 'Produk') . ' (' . strtoupper($detail->size) . ')', 0, 50),
            ];
        }

        $payload = [
            'transaction_details' => [
                'order_id'     => $midtransOrderId,
                'gross_amount' => (int) round($order->total_price),
            ],
            'item_details' => $items,
            'customer_details' => [
                'first_name' => $order->user->first_name ?? 'Customer',
                'last_name'  => $order->user->last_name  ?? '',
                'email'      => $order->user->email      ?? '',
                'phone'      => $order->user->no_telp    ?? '',
            ],
            /*
             * credit_card: required=false agar Midtrans tidak hanya
             * menampilkan kartu kredit sebagai satu-satunya opsi.
             */
            'credit_card' => [
                'secure' => true,
            ],
        ];

        $allowedMethods = ['qris', 'bri_va', 'bca_va'];
        $chosenMethod   = $request->query('method');

        $response = Http::withBasicAuth($serverKey, '')
            ->acceptJson()
            ->post($this->snapBaseUrl() . '/snap/v1/transactions', $payload);

        // Log payload dan response untuk diagnosis
        Log::info('Midtrans payload sent', [
            'url'     => $this->snapBaseUrl() . '/snap/v1/transactions',
            'payload' => $payload,
        ]);
        Log::info('Midtrans response', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        if (!$response->successful() || !$response->json('token')) {
            Log::error('Midtrans Snap error', ['body' => $response->body()]);
            Session::flash('error', 'Gagal membuat transaksi pembayaran. Coba lagi nanti. Error: ' . $response->body());
            return redirect('/orders/' . $order->id);
        }

        $token = $response->json('token');

        $order->update([
            'snap_token' => $token,
            'midtrans_order_id' => $midtransOrderId,
        ]);

        $clientKey = config('services.midtrans.client_key');
        $snapJs = $this->snapBaseUrl() . '/snap/snap.js';

        // Jika ada method terpilih → tampilkan snap langsung (snap.blade.php)
        // Jika tidak ada method → tampilkan halaman pilih metode (pay.blade.php)
        if ($chosenMethod && in_array($chosenMethod, $allowedMethods)) {
            return view('payment.snap', compact('order', 'token', 'clientKey', 'snapJs', 'chosenMethod'));
        }

        return view('payment.pay', compact('order', 'token', 'clientKey', 'snapJs'));
    }

    public function notification(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $payload = $request->all();

        $orderId = $payload['order_id'] ?? null;
        $statusCode = $payload['status_code'] ?? null;
        $grossAmount = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;

        if (!$orderId || !$statusCode || !$grossAmount || !$signatureKey) {
            return response()->json(['message' => 'invalid payload'], 400);
        }

        $expected = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        if (!hash_equals($expected, $signatureKey)) {
            Log::warning('Midtrans invalid signature', ['order_id' => $orderId]);
            return response()->json(['message' => 'invalid signature'], 403);
        }

        $order = OrderModel::with('details')->where('midtrans_order_id', $orderId)->first();
        if (!$order) {
            return response()->json(['message' => 'order not found'], 404);
        }

        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;
        $paymentType = $payload['payment_type'] ?? null;

        if (in_array($transactionStatus, ['capture', 'settlement'])) {
            if ($transactionStatus === 'capture' && $fraudStatus === 'challenge') {
                // tunggu review manual, biarkan pending
            } else {
                if ($order->status === 'pending') {
                    $order->update([
                        'status' => 'paid',
                        'payment_type' => $paymentType,
                        'paid_at' => now(),
                    ]);
                }
            }
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            if (!in_array($order->status, ['cancelled', 'completed'])) {
                DB::transaction(function () use ($order) {
                    foreach ($order->details as $detail) {
                        $product = ProductsModel::find($detail->product_id);
                        if ($product && $product->stock !== null) {
                            $product->increment('stock', $detail->quantity);
                        }
                    }
                    $order->update(['status' => 'cancelled']);
                });
            }
        }

        return response()->json(['message' => 'ok']);
    }

    public function finish(Request $request)
    {
        return redirect('/orders')->with('success', 'Terima kasih! Status pembayaran akan diperbarui otomatis.');
    }
}
