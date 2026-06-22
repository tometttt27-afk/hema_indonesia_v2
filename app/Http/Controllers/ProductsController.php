<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /* ══════════════════════════════════════════════════════════
     |  CUSTOMER — Katalog Produk (SELECT + filter/paginate)
     |
     |  Alur End-to-End Tahap 3 (Tampil di Customer):
     |  Admin simpan produk (is_active=1) → query ini langsung
     |  menampilkan produk tersebut di halaman /product.
     ══════════════════════════════════════════════════════════*/
    public function index(Request $request)
    {
        $categories_product = CategoriesModel::orderBy('name')->get();

        // Query dasar: pakai scope active() dari Model
        $query = ProductsModel::with('categories')->active();

        // ── Filter: pencarian nama / deskripsi ──────────────
        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // ── Filter: kategori (by category_code) ─────────────
        if ($request->filled('category')) {
            $query->whereHas('categories', fn($c) =>
                $c->where('category_code', $request->category)
            );
        }

        // ── Filter: rentang harga (berdasar final_price) ─────
        if ($request->filled('min_price')) {
            $query->where('final_price', '>=', (float) $request->min_price);
        }
        if ($request->filled('max_price') && (float) $request->max_price > 0) {
            $query->where('final_price', '<=', (float) $request->max_price);
        }

        // ── Filter: hanya yang diskon ────────────────────────
        if ($request->boolean('on_sale')) {
            $query->onSale();
        }

        // ── Filter: hanya stok tersedia ──────────────────────
        if ($request->boolean('in_stock')) {
            $query->inStock();
        }

        // ── Pengurutan ───────────────────────────────────────
        match ($request->sort) {
            'price_asc'  => $query->orderBy('final_price', 'asc'),
            'price_desc' => $query->orderBy('final_price', 'desc'),
            'name_asc'   => $query->orderBy('name', 'asc'),
            'name_desc'  => $query->orderBy('name', 'desc'),
            'oldest'     => $query->orderBy('created_at', 'asc'),
            default      => $query->orderBy('created_at', 'desc'),  // terbaru dulu
        };

        $data          = $query->paginate(12)->withQueryString();
        $count_product = $data->total();

        return view('product.main', compact('data', 'count_product', 'categories_product'));
    }

    /* ══════════════════════════════════════════════════════════
     |  ADMIN — Daftar Produk (Tahap 2: SELECT di Admin)
     |
     |  Menampilkan SEMUA produk (aktif & tidak aktif), diurutkan
     |  terbaru terlebih dahulu agar produk baru langsung terlihat
     |  di baris pertama tabel setelah Insert berhasil.
     ══════════════════════════════════════════════════════════*/
    public function productsListIndex()
    {
        $data = ProductsModel::with('categories')
                             ->latestFirst()   // scope dari Model
                             ->get();

        return view('product.data.index', compact('data'));
    }

    /* ══════════════════════════════════════════════════════════
     |  ADMIN — Form Tambah Produk
     ══════════════════════════════════════════════════════════*/
    public function productsListAdd()
    {
        $categories = CategoriesModel::orderBy('name')->get();
        return view('product.data.add', compact('categories'));
    }

    /* ══════════════════════════════════════════════════════════
     |  ADMIN — Simpan Produk Baru (Tahap 1: INSERT ke DB)
     |
     |  Alur:
     |  1. Validasi semua field
     |  2. Upload & simpan gambar ke /uploads/products/
     |  3. Hitung final_price dari price & discount
     |  4. INSERT ke tabel products (ProductsModel::create)
     |  5. Redirect ke /product-list dengan flash success
     |     → Admin langsung melihat produk baru di tabel (Tahap 2)
     |  6. Jika is_active=1 → produk otomatis muncul di /product
     |     (Tahap 3) tanpa tindakan tambahan
     ══════════════════════════════════════════════════════════*/
    public function productsListStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'code_product' => 'required|string|max:100|unique:products,code_product',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'discount'     => 'nullable|numeric|min:0|max:100',
            'stock'        => 'required|integer|min:0',
            'category_id'  => 'required|exists:categories,id',
            'size'         => 'required|array|min:1',
            'size.*'       => 'in:xs,s,m,l,xl,xxl,xxxl,custom',
            'is_active'    => 'required|in:0,1',
            'image'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required'         => 'Nama produk harus diisi.',
            'code_product.required' => 'Kode produk harus diisi.',
            'code_product.unique'   => 'Kode produk sudah digunakan, pilih kode lain.',
            'description.required'  => 'Deskripsi produk harus diisi.',
            'price.required'        => 'Harga produk harus diisi.',
            'price.numeric'         => 'Harga harus berupa angka.',
            'price.min'             => 'Harga tidak boleh negatif.',
            'discount.max'          => 'Diskon maksimal 100%.',
            'stock.required'        => 'Stok produk harus diisi.',
            'stock.integer'         => 'Stok harus berupa bilangan bulat.',
            'stock.min'             => 'Stok tidak boleh negatif.',
            'category_id.required'  => 'Kategori produk harus dipilih.',
            'category_id.exists'    => 'Kategori yang dipilih tidak valid.',
            'size.required'         => 'Minimal satu ukuran harus dipilih.',
            'is_active.required'    => 'Status produk harus dipilih.',
            'image.required'        => 'Gambar produk harus diunggah.',
            'image.image'           => 'File harus berupa gambar.',
            'image.mimes'           => 'Format gambar: JPEG, PNG, JPG, atau WebP.',
            'image.max'             => 'Ukuran gambar maksimal 2 MB.',
        ]);

        if ($validator->fails()) {
            return redirect('/product-list/add-product-list')
                ->withErrors($validator)
                ->withInput();
        }

        // ── Upload gambar ────────────────────────────────────
        $imageName = $this->uploadProductImage($request);

        // ── Hitung harga akhir ───────────────────────────────
        $price      = (float) $request->price;
        $discount   = (float) ($request->discount ?? 0);
        $finalPrice = $price - ($price * $discount / 100);

        // ── INSERT ke tabel products ─────────────────────────
        $product = ProductsModel::create([
            'name'         => trim($request->name),
            'code_product' => strtolower(trim($request->code_product)),
            'description'  => trim($request->description),
            'price'        => $price,
            'discount'     => $discount,
            'final_price'  => round($finalPrice, 2),
            'stock'        => (int) $request->stock,
            'category_id'  => $request->category_id,
            'size'         => implode(', ', $request->size),
            'image'        => $imageName,
            'is_active'    => (int) $request->is_active,
        ]);

        $visibilityNote = $product->is_active
            ? 'Produk langsung tampil di halaman katalog customer.'
            : 'Produk tersimpan dengan status Tidak Aktif — tidak akan muncul di katalog.';

        return redirect('/product-list')
            ->with('success', "Produk \"{$product->name}\" berhasil ditambahkan. {$visibilityNote}");
    }

    /* ══════════════════════════════════════════════════════════
     |  ADMIN — Form Edit Produk
     ══════════════════════════════════════════════════════════*/
    public function productsListEdit(string $code_product)
    {
        $data       = ProductsModel::where('code_product', $code_product)->firstOrFail();
        $categories = CategoriesModel::orderBy('name')->get();
        return view('product.data.edit', compact('data', 'categories'));
    }

    /* ══════════════════════════════════════════════════════════
     |  ADMIN — Update Produk (UPDATE di DB)
     ══════════════════════════════════════════════════════════*/
    public function productsListUpdate(Request $request, string $code_product)
    {
        $product = ProductsModel::where('code_product', $code_product)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'discount'    => 'nullable|numeric|min:0|max:100',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'size'        => 'required|array|min:1',
            'size.*'      => 'in:xs,s,m,l,xl,xxl,xxxl,custom',
            'is_active'   => 'required|in:0,1',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required'        => 'Nama produk harus diisi.',
            'description.required' => 'Deskripsi produk harus diisi.',
            'price.required'       => 'Harga produk harus diisi.',
            'discount.max'         => 'Diskon maksimal 100%.',
            'stock.required'       => 'Stok produk harus diisi.',
            'stock.integer'        => 'Stok harus berupa bilangan bulat.',
            'category_id.required' => 'Kategori produk harus dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'size.required'        => 'Minimal satu ukuran harus dipilih.',
            'is_active.required'   => 'Status produk harus dipilih.',
            'image.image'          => 'File harus berupa gambar.',
            'image.mimes'          => 'Format gambar: JPEG, PNG, JPG, atau WebP.',
            'image.max'            => 'Ukuran gambar maksimal 2 MB.',
        ]);

        if ($validator->fails()) {
            return redirect('/product-list/edit-product-list/' . strtolower($product->code_product))
                ->withErrors($validator)
                ->withInput();
        }

        // Upload gambar baru jika ada, gunakan yang lama jika tidak
        $imageName = $request->hasFile('image')
            ? $this->uploadProductImage($request)
            : $product->image;

        $price      = (float) $request->price;
        $discount   = (float) ($request->discount ?? 0);
        $finalPrice = $price - ($price * $discount / 100);

        $product->update([
            'name'        => trim($request->name),
            'description' => trim($request->description),
            'price'       => $price,
            'discount'    => $discount,
            'final_price' => round($finalPrice, 2),
            'stock'       => (int) $request->stock,
            'category_id' => $request->category_id,
            'size'        => implode(', ', $request->size),
            'image'       => $imageName,
            'is_active'   => (int) $request->is_active,
        ]);

        return redirect('/product-list')
            ->with('success', "Produk \"{$product->name}\" berhasil diperbarui.");
    }

    /* ══════════════════════════════════════════════════════════
     |  ADMIN — Toggle Status Aktif
     ══════════════════════════════════════════════════════════*/
    public function productsListStatusUpdate(Request $request, string $code_product)
    {
        $product = ProductsModel::where('code_product', $code_product)->firstOrFail();

        // Toggle: jika saat ini 1 → jadi 0, dan sebaliknya
        $newStatus = $product->is_active ? 0 : 1;
        $product->update(['is_active' => $newStatus]);

        $msg = $newStatus
            ? "Produk \"{$product->name}\" diaktifkan dan sekarang tampil di katalog."
            : "Produk \"{$product->name}\" dinonaktifkan dan disembunyikan dari katalog.";

        return redirect('/product-list')->with('success', $msg);
    }

    /* ══════════════════════════════════════════════════════════
     |  ADMIN — Hapus Produk
     ══════════════════════════════════════════════════════════*/
    public function productsListDestroy(string $code_product)
    {
        $product = ProductsModel::where('code_product', $code_product)->firstOrFail();
        $name    = $product->name;
        $product->delete();

        return redirect('/product-list')
            ->with('success', "Produk \"{$name}\" berhasil dihapus.");
    }

    /* ══════════════════════════════════════════════════════════
     |  ADMIN — Kategori (CRUD)
     ══════════════════════════════════════════════════════════*/
    public function categoriesIndex()
    {
        $data = CategoriesModel::withCount('products')->orderBy('name')->get();
        return view('categories.index', compact('data'));
    }

    public function categoriesAdd()
    {
        return view('categories.add');
    }

    public function categoriesStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:100',
            'category_code' => 'required|string|max:50|unique:categories,category_code',
            'description'   => 'required|string',
        ], [
            'name.required'          => 'Nama kategori harus diisi.',
            'category_code.required' => 'Kode kategori harus diisi.',
            'category_code.unique'   => 'Kode kategori sudah digunakan.',
            'description.required'   => 'Deskripsi kategori harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect('/categories/add-categories')
                ->withErrors($validator)
                ->withInput();
        }

        CategoriesModel::create([
            'name'          => trim($request->name),
            'category_code' => strtolower(trim($request->category_code)),
            'description'   => trim($request->description),
        ]);

        return redirect('/categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function categoriesEdit(string $category_code)
    {
        $data = CategoriesModel::where('category_code', $category_code)->firstOrFail();
        return view('categories.edit', compact('data'));
    }

    public function categoriesUpdate(Request $request, string $category_code)
    {
        $data = CategoriesModel::where('category_code', $category_code)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:100',
            'description' => 'required|string',
        ], [
            'name.required'        => 'Nama kategori harus diisi.',
            'description.required' => 'Deskripsi kategori harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect('/categories/edit-categories/' . strtolower($data->category_code))
                ->withErrors($validator)
                ->withInput();
        }

        $data->update([
            'name'        => trim($request->name),
            'description' => trim($request->description),
        ]);

        return redirect('/categories')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function categoriesDestroy(string $category_code)
    {
        $data = CategoriesModel::where('category_code', $category_code)->firstOrFail();
        $name = $data->name;
        $data->delete();

        return redirect('/categories')->with('success', "Kategori \"{$name}\" berhasil dihapus.");
    }

    /* ══════════════════════════════════════════════════════════
     |  PRIVATE HELPER — Upload gambar produk
     ══════════════════════════════════════════════════════════*/
    private function uploadProductImage(Request $request): string
    {
        $file      = $request->file('image');
        $ext       = $file->getClientOriginalExtension();
        $slug      = Str::slug(substr($request->input('name', 'product'), 0, 30));
        $imageName = 'product_' . $slug . '_' . uniqid() . '.' . $ext;

        // Pastikan direktori ada
        $uploadPath = public_path('uploads/products');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $file->move($uploadPath, $imageName);
        return $imageName;
    }
}
