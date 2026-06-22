<?php

namespace App\Http\Controllers;

use App\Models\AboutCompanyModel;
use App\Models\CategoriesModel;
use App\Models\FaqCompanyModel;
use App\Models\GalleryModel;
use App\Models\NewsEmail;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    /**
     * Homepage — inject semua data dinamis dari DB:
     *  - profil perusahaan (about_company)
     *  - galeri aktif (gallery)  → ditampilkan di scrolling strip
     *  - produk unggulan (4 produk terbaru + aktif)
     *  - kategori aktif
     */
    public function index()
    {
        $data_about = AboutCompanyModel::first();

        // Galeri aktif untuk scrolling strip homepage
        $hero_gallery = GalleryModel::where('is_active', 1)
                                    ->latest()
                                    ->take(8)
                                    ->get();

        // Produk unggulan — 4 produk terbaru yang aktif
        $featured_products = ProductsModel::with('categories')
                                          ->where('is_active', 1)
                                          ->latest()
                                          ->take(4)
                                          ->get();

        // Semua kategori aktif (untuk tombol filter cepat di homepage)
        $categories = CategoriesModel::has('products')->get();

        // Statistik perusahaan (COUNT dari DB — bukan hardcode)
        $stats = [
            'total_products'    => ProductsModel::where('is_active', 1)->count(),
            'total_categories'  => CategoriesModel::count(),
        ];

        return view('main.main-content', compact(
            'data_about',
            'hero_gallery',
            'featured_products',
            'categories',
            'stats',
        ));
    }

    public function news_email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Input email harus diisi',
            'email.email'    => 'Input email harus diisi format @',
        ]);

        if ($validator->fails()) {
            return redirect('/')->withErrors($validator)->withInput();
        }

        NewsEmail::create(['email' => $request->input('email')]);
        Session::flash('success', 'Email berhasil didaftarkan ke newsletter');
        return redirect('/');
    }

    public function about()
    {
        $data_about = AboutCompanyModel::first();
        return view('main.about', compact('data_about'));
    }

    public function gallery()
    {
        $data          = GalleryModel::where('is_active', 1)->latest()->get();
        $count_gallery = $data->count();
        return view('main.gallery', compact('data', 'count_gallery'));
    }

    public function faq()
    {
        $data      = FaqCompanyModel::where('is_active', 1)->get();
        $count_faq = $data->count();
        return view('main.faq', compact('data', 'count_faq'));
    }
}
