<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categories_product = CategoriesModel::all();

        $query = ProductsModel::with('categories')->where('is_active', 1);

        // Pencarian (nama atau deskripsi)
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // Filter kategori (berdasarkan category_code)
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($c) use ($request) {
                $c->where('category_code', $request->category);
            });
        }

        // Filter rentang harga (memakai harga akhir/final_price)
        if ($request->filled('min_price')) {
            $query->where('final_price', '>=', (float) $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('final_price', '<=', (float) $request->max_price);
        }

        // Hanya produk diskon
        if ($request->boolean('on_sale')) {
            $query->where('discount', '>', 0);
        }

        // Hanya yang tersedia (stok null dianggap tak terbatas)
        if ($request->boolean('in_stock')) {
            $query->where(function ($s) {
                $s->whereNull('stock')->orWhere('stock', '>', 0);
            });
        }

        // Urutkan
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('final_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('final_price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $data = $query->paginate(12)->withQueryString();
        $count_product = $data->total();

        return view('product.main', compact(['data', 'count_product', 'categories_product']));
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
            'price' => 'required|min:0',
            'discount' => 'nullable|min:0|max:100|lte:price',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required',
            'size' => 'required|array',
            'size.*' => 'in:xs,s,m,l,xl,xxl,xxxl,custom',
            'is_active' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'name.required' => 'Input first nama produk harus diisi',
            'code_product.unique' => 'Kode produk tersebut sudah tersedia',
            'description.required' => 'Input deskripsi produk harus diisi',
            'price.required' => 'Input harga produk harus diisi',
            'discount.max' => 'Maksimal diskon 100%',
            'stock.required' => 'Input stok produk harus diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok tidak boleh negatif',
            'category_id.required' => 'Input kategori produk harus diisi',
            'size.required' => 'Input ukuran produk harus diisi',
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

        $price = $request->price;
        $discount = $request->discount ?? 0;
        $final_price = $price - ($price * $discount / 100);

        ProductsModel::create([
            'name' => $request->name,
            'code_product' => $request->code_product,
            'description' => $request->description,
            'price' => $price,
            'discount' => $discount,
            'final_price' => $final_price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'size' => implode(', ', $request->size),
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
            'price' => 'required|min:0',
            'discount' => 'nullable|min:0|max:100|lte:price',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required',
            'size' => 'required|array',
            'size.*' => 'in:xs,s,m,l,xl,xxl,xxxl,custom',
            'is_active' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'name.required' => 'Input first nama produk harus diisi',
            'description.required' => 'Input deskripsi produk harus diisi',
            'price.required' => 'Input harga produk harus diisi',
            'discount.max' => 'Maksimal diskon 100%',
            'stock.required' => 'Input stok produk harus diisi',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok tidak boleh negatif',
            'category_id.required' => 'Input kategori produk harus diisi',
            'size.required' => 'Input ukuran produk harus diisi',
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

        $price = $request->price;
        $discount = $request->discount ?? 0;
        $final_price = $price - ($price * $discount / 100);

        $data->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $price,
            'discount' => $discount,
            'final_price' => $final_price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'size' => implode(', ', $request->size),
            'image' => $name_product,
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

    public function categoriesIndex()
    {
        $data = CategoriesModel::all();
        return view('categories.index', compact(['data']));
    }

    public function categoriesAdd()
    {
        return view('categories.add');
    }

    public function categoriesStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_code' => 'unique:categories,category_code',
            'description' => 'required'
        ], [
            'name.required' => 'Input nama kategori harus diisi',
            'category_code.unique' => 'Kode kategori tersebut sudah tersedia',
            'description.required' => 'Input deskripsi kategori harus diisi',
        ]);

        if ($validator->fails()) return redirect('/categories/add-categories')->withErrors($validator)->withInput();

        CategoriesModel::create([
            'name' => $request->input('name'),
            'category_code' => $request->input('category_code'),
            'description' => $request->input('description')
        ]);

        return redirect('/categories')->with('success', 'Tambah kategori produk berhasil');
    }

    public function categoriesEdit($category_code)
    {
        $data = CategoriesModel::where('category_code', $category_code)->firstOrFail();
        return view('categories.edit', compact('data'));
    }

    public function categoriesUpdate(Request $request, $category_code)
    {
        $data = CategoriesModel::where('category_code', $category_code)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'Input nama kategori harus diisi',
            'description.required' => 'Input deskripsi kategori harus diisi',
        ]);

        if ($validator->fails()) return redirect('/categories/edit-categories/' . strtolower($data->category_code))->withErrors($validator)->withInput();

        $data->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect('/categories')->with('success', 'Ubah kategori produk berhasil');
    }

    public function categoriesDestroy($category_code)
    {
        $data = CategoriesModel::where('category_code', $category_code)->firstOrFail();
        $data->delete();
        return redirect('/categories')->with('success', 'Hapus kategori produk berhasil');
    }
}