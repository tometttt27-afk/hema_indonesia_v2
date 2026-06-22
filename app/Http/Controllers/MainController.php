<?php

namespace App\Http\Controllers;

use App\Models\AboutCompanyModel;
use App\Models\FaqCompanyModel;
use App\Models\GalleryModel;
use App\Models\NewsEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function index()
    {
        return view('main.main-content');
    }

    public function news_email(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'email'], ['email.email' => 'Input email harus diisi format @']);
        if ($validator->fails()) return redirect('/')->withErrors($validator)->withInput();

        $message = NewsEmail::create(['email' => $request->input('email')]);
        if ($message) {
            Session::flash('success', 'News email anda berhasil dikirim');
            return redirect('/');
        }
    }

    public function about()
    {
        $data_about = AboutCompanyModel::first();
        return view('main.about', compact(['data_about']));
    }

    public function gallery()
    {
        $data = GalleryModel::where('is_active', 1)->get();
        $count_gallery = $data->count();
        return view('main.gallery', compact(['data', 'count_gallery']));
    }

    public function faq()
    {
        $data = FaqCompanyModel::where('is_active', 1)->get();
        $count_faq = $data->count();
        return view('main.faq', compact(['data', 'count_faq']));
    }
}