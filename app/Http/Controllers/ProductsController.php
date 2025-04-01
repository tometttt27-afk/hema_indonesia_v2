<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        return view('product.main');
    }

    public function productsListIndex()
    {
        $data = ProductsModel::with('categories')->get();
        return view('product.data.index', compact(['data']));
    }

    public function productsListAdd()
    {
        $categories = CategoriesModel::all();
        return view('product.data.add', compact('categories'));
    }

    public function productsListStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code_product' => 'unique:products,code_product',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            // 'categories' => 'required',
            // 'size' => 'required',
            'is_active' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'name.required' => 'Input first nama produk harus diisi',
            'code_product.unique' => 'Kode produk tersebut sudah tersedia',
            'description.required' => 'Input deskripsi produk harus diisi',
            'price.required' => 'Input harga produk harus diisi',
            'stock.required' => 'Input stok produk harus diisi',
            // 'categories.required' => 'Input kategori produk harus diisi',
            // 'size.required' => 'Input ukuran produk harus diisi',
            'is_active.required' => 'Input status produk harus diisi',
            'image.required' => 'Input gambar produk harus diisi',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 1MB.',
        ]);

        if ($validator->fails()) return redirect('/product-list/add-product-list')->withErrors($validator)->withInput();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name_product = 'products_' . uniqid() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/products', $name_product);
        }
        ProductsModel::create([
            'name' => $request->name,
            'code_product' => $request->code_product,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'size' => $request->size,
            'image' => $name_product,
            'is_active' => $request->is_active
        ]);

        return redirect('/product-list')->with('success', 'Tambah data produk berhasil');
    }

    public function productsListEdit($code_product)
    {
        $data = ProductsModel::where('code_product', $code_product)->firstOrFail();
        $categories = CategoriesModel::all();
        return view('product.data.edit', compact(['data', 'categories']));
    }

    public function productsListUpdate(Request $request, $code_product)
    {
        $data = ProductsModel::where('code_product', $code_product)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            // 'categories' => 'required',
            // 'size' => 'required',
            'is_active' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'name.required' => 'Input first nama produk harus diisi',
            'description.required' => 'Input deskripsi produk harus diisi',
            'price.required' => 'Input harga produk harus diisi',
            'stock.required' => 'Input stok produk harus diisi',
            // 'categories.required' => 'Input kategori produk harus diisi',
            // 'size.required' => 'Input ukuran produk harus diisi',
            'is_active.required' => 'Input status produk harus diisi',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 1MB.',
        ]);


        if ($validator->fails()) return redirect('/product-list/edit-product-list/' . strtolower($data->code_product))->withErrors($validator)->withInput();

        $name_product = $data->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name_product = 'products_' . uniqid() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/products', $name_product);
        }

        $data->update([
            'name' => $request->name,
            'code_product' => $request->code_product,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'size' => $request->size,
            'image' => $name_product
        ]);

        return redirect('/product-list')->with('success', 'Ubah data produk berhasil');
    }

    public function productsListStatusUpdate(Request $request, $code_product)
    {
        $data = ProductsModel::where('code_product', $code_product)->firstOrFail();
        $data->update(['is_active' => $request->has('is_active') && $request->is_active == '1' ? 0 : 1]);
        return redirect('/product-list')->with('success', 'Ubah status data produk berhasil');
    }

    public function productsListDestroy($code_product)
    {
        $data = ProductsModel::where('code_product', $code_product)->firstOrFail();
        $data->delete();
        return redirect('/product-list')->with('success', 'Hapus data produk berhasil');
    }
}