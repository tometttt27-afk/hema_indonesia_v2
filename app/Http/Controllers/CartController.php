<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'qty' => 'required|integer|min:1',
        ], [
            'product_id.required' => 'Produk tidak valid',
            'product_id.exists' => 'Produk tidak ditemukan',
            'size.required' => 'Silakan pilih ukuran terlebih dahulu',
            'qty.required' => 'Jumlah harus diisi',
            'qty.min' => 'Jumlah minimal 1',
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        $product = ProductsModel::findOrFail($request->product_id);

        if (!$product->is_active) {
            Session::flash('error', 'Produk tidak tersedia');
            return redirect()->back();
        }

        $price = $product->final_price ?? $product->price;
        $size = strtolower(trim($request->size));
        $key = $product->id . '-' . $size;

        $cart = Session::get('cart', []);
        $currentQty = isset($cart[$key]) ? $cart[$key]['qty'] : 0;
        $newQty = $currentQty + (int) $request->qty;

        if ($product->stock !== null && $newQty > $product->stock) {
            Session::flash('error', 'Jumlah melebihi stok yang tersedia (' . $product->stock . ')');
            return redirect()->back();
        }

        $cart[$key] = [
            'product_id' => $product->id,
            'code_product' => $product->code_product,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $price,
            'size' => $size,
            'qty' => $newQty,
        ];

        Session::put('cart', $cart);
        Session::save();

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function update(Request $request, $key)
    {
        $validator = Validator::make($request->all(), [
            'qty' => 'required|integer|min:1',
        ], [
            'qty.required' => 'Jumlah harus diisi',
            'qty.min' => 'Jumlah minimal 1',
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator);

        $cart = Session::get('cart', []);

        if (!isset($cart[$key])) {
            Session::flash('error', 'Item tidak ditemukan di keranjang');
            return redirect()->back();
        }

        $product = ProductsModel::find($cart[$key]['product_id']);
        if ($product && $product->stock !== null && $request->qty > $product->stock) {
            Session::flash('error', 'Jumlah melebihi stok yang tersedia (' . $product->stock . ')');
            return redirect()->back();
        }

        $cart[$key]['qty'] = (int) $request->qty;
        Session::put('cart', $cart);
        Session::save();

        return redirect()->back()->with('success', 'Keranjang diperbarui');
    }

    public function remove($key)
    {
        // Guard: jangan hapus jika key adalah 'clear' (menghindari route conflict)
        if ($key === 'clear') {
            return $this->clear();
        }

        $cart = Session::get('cart', []);
        if (isset($cart[$key])) {
            unset($cart[$key]);
            Session::put('cart', $cart);
            Session::save();
        }
        return redirect()->back()->with('success', 'Item dihapus dari keranjang');
    }

    public function clear()
    {
        Session::forget('cart');
        Session::save();
        return redirect()->back()->with('success', 'Keranjang dikosongkan');
    }
}
