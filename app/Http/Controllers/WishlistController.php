<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use App\Models\WishlistModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {
        $data = WishlistModel::with('product.categories')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('wishlist.index', compact('data'));
    }

    public function store(Request $request, $product_id)
    {
        $product = ProductsModel::findOrFail($product_id);

        $exists = WishlistModel::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($exists) {
            Session::flash('error', 'Produk sudah ada di wishlist anda');
            return redirect()->back();
        }

        WishlistModel::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Produk ditambahkan ke wishlist');
    }

    public function destroy($id)
    {
        $data = WishlistModel::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $data->delete();
        return redirect()->back()->with('success', 'Produk dihapus dari wishlist');
    }
}
