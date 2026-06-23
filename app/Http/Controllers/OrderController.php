<?php

namespace App\Http\Controllers;

use App\Models\DetailOrderModel;
use App\Models\OrderModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            Session::flash('error', 'Keranjang anda masih kosong');
            return redirect('/cart');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $user = Auth::user();
        return view('orders.checkout', compact('cart', 'total', 'user'));
    }

    public function store(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            Session::flash('error', 'Keranjang anda masih kosong');
            return redirect('/cart');
        }

        // Validasi: No. Telp dan Alamat harus sudah diisi sebelum order
        $user = Auth::user();
        if (empty($user->no_telp) || empty($user->address)) {
            $missing = [];
            if (empty($user->no_telp)) $missing[] = 'No. Telepon';
            if (empty($user->address)) $missing[] = 'Alamat Lengkap';
            Session::flash('error', 'Harap lengkapi ' . implode(' dan ', $missing) . ' di halaman profil sebelum melanjutkan pesanan.');
            return redirect('/checkout');
        }

        $order = null;
        try {
            $order = DB::transaction(function () use ($cart) {
                $total = 0;

                // Validasi stok terlebih dahulu (kunci baris)
                foreach ($cart as $item) {
                    $product = ProductsModel::lockForUpdate()->find($item['product_id']);
                    if (!$product || !$product->is_active) {
                        throw new \Exception('Produk "' . $item['name'] . '" tidak tersedia lagi');
                    }
                    if ($product->stock !== null && $item['qty'] > $product->stock) {
                        throw new \Exception('Stok "' . $product->name . '" tidak mencukupi (tersisa ' . $product->stock . ')');
                    }
                    $total += $item['price'] * $item['qty'];
                }

                $order = OrderModel::create([
                    'user_id' => Auth::id(),
                    'total_price' => $total,
                    'status' => 'pending',
                ]);

                foreach ($cart as $item) {
                    DetailOrderModel::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'size' => $item['size'],
                        'quantity' => $item['qty'],
                        'price' => $item['price'],
                    ]);

                    $product = ProductsModel::find($item['product_id']);
                    if ($product->stock !== null) {
                        $product->decrement('stock', $item['qty']);
                    }
                }

                return $order;
            });
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect('/cart');
        }

        Session::forget('cart');
        return redirect('/orders/' . $order->id)->with('success', 'Pesanan berhasil dibuat');
    }

    public function index()
    {
        $data = OrderModel::with('details.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('orders.index', compact('data'));
    }

    public function show($id)
    {
        $data = OrderModel::with('details.product')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        return view('orders.show', compact('data'));
    }

    public function cancel($id)
    {
        $order = OrderModel::with('details')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!in_array($order->status, ['pending', 'paid'])) {
            Session::flash('error', 'Pesanan ini tidak dapat dibatalkan');
            return redirect()->back();
        }

        DB::transaction(function () use ($order) {
            foreach ($order->details as $detail) {
                $product = ProductsModel::find($detail->product_id);
                if ($product && $product->stock !== null) {
                    $product->increment('stock', $detail->quantity);
                }
            }
            $order->update(['status' => 'cancelled']);
        });

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function complete($id)
    {
        $order = OrderModel::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($order->status !== 'shipped') {
            Session::flash('error', 'Pesanan belum dikirim sehingga tidak dapat diselesaikan');
            return redirect()->back();
        }

        $order->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Terima kasih, pesanan telah selesai');
    }
}
