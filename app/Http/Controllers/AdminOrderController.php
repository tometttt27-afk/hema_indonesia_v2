<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminOrderController extends Controller
{
    public function index()
    {
        $data = OrderModel::with('user')->latest()->get();
        return view('order.index', compact('data'));
    }

    public function show($id)
    {
        $data = OrderModel::with(['details.product', 'user'])->findOrFail($id);
        return view('order.show', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,paid,shipped,completed,cancelled',
        ], [
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator);

        $order = OrderModel::with('details')->findOrFail($id);
        $newStatus = $request->status;

        // Kembalikan stok jika dibatalkan (dan belum dibatalkan sebelumnya)
        if ($newStatus === 'cancelled' && $order->status !== 'cancelled') {
            DB::transaction(function () use ($order) {
                foreach ($order->details as $detail) {
                    $product = ProductsModel::find($detail->product_id);
                    if ($product && $product->stock !== null) {
                        $product->increment('stock', $detail->quantity);
                    }
                }
                $order->update(['status' => 'cancelled']);
            });
            return redirect()->back()->with('success', 'Pesanan dibatalkan & stok dikembalikan');
        }

        $order->update(['status' => $newStatus]);
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}
