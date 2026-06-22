<?php

namespace App\Http\Controllers;

use App\Models\AboutCompanyModel;
use App\Models\CategoriesModel;
use App\Models\FaqCompanyModel;
use App\Models\GalleryModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DataMasterController extends Controller
{
    public function aboutCompanyIndex()
    {
        $data = AboutCompanyModel::first();
        return view('about_company.index', compact('data'));
    }

    public function aboutCompanyUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'about_description_company' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg|max:1024',
            'about_img_company' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'name.required' => 'Input nama perusahaan harus diisi',
            'name.string' => 'Input nama perusahaan harus berupa string',
            'about_description_company.required' => 'Input deskripsi perusahaan harus diisi',
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.mimes' => 'Format logo harus jpeg, png, atau jpg.',
            'logo.max' => 'Ukuran logo maksimal 1MB.',
            'about_img_company.image' => 'File gambar harus berupa gambar.',
            'about_img_company.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'about_img_company.max' => 'Ukuran gambar maksimal 1MB.',
        ]);

        if ($validator->fails()) return redirect('/about-company')->withErrors($validator)->withInput();

        $data = AboutCompanyModel::first() ?? new AboutCompanyModel();

        $name_logo = $data->logo;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name_logo = 'logo_' . uniqid() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/about', $name_logo);
        }

        $name_about_img = $data->about_img_company;
        if ($request->hasFile('about_img_company')) {
            $file = $request->file('about_img_company');
            $name_about_img = 'about_' . uniqid() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/about', $name_about_img);
        }

        $data->fill([
            'name' => $request->name,
            'breadcrumb' => $request->breadcrumb,
            'about_description_company' => $request->about_description_company,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'facebook' => $request->facebook,
            'youtube' => $request->youtube,
            'logo' => $name_logo,
            'about_img_company' => $name_about_img,
        ]);
        $data->save();

        return redirect('/about-company')->with('success', 'Data perusahaan berhasil diperbarui');
    }

    public function customerIndex()
    {
        $data = User::where('role', 'customer')->get();
        return view('customer.index', compact(['data']));
    }

    public function customerAdd()
    {
        return view('customer.add');
    }

    public function customerStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'profile_img' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'first_name.required' => 'Input first name harus diisi',
            'first_name.string' => 'Input first name harus diisi dengan string',
            'last_name.required' => 'Input last name harus diisi',
            'last_name.string' => 'Input last name harus diisi dengan string',
            'email.required' => 'Input email harus diisi',
            'email.email' => 'Input email harus diisi format @',
            'email.unique' => 'Email tersebut sudah tersedia',
            'password.required' => 'Input password harus diisi',
            'password.min' => 'Input password minimal 8 karakter',
            'profile_img.image' => 'File harus berupa gambar.',
            'profile_img.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'profile_img.max' => 'Ukuran gambar maksimal 1MB.',
        ]);

        if ($validator->fails()) return redirect('/customer/add-customer')->withErrors($validator)->withInput();

        $nama_profile = 'default_profile.jpg';
        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $nama_profile = 'profile_' . uniqid() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/profile', $nama_profile);
        }
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'no_telp' => $request->no_telp,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'status' => $request->status,
            'role' => 'customer',
            'profile_img' => $nama_profile,
        ]);

        return redirect('/customer')->with('success', 'Tambah data pelanggan berhasil');
    }

    public function customerEdit($email)
    {
        $data = User::where('email', $email)->firstOrFail();
        return view('customer.edit', compact('data'));
    }

    public function customerUpdate(Request $request, $email)
    {
        $data = User::where('email', $email)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $data->id,
            'password' => 'nullable|min:8',
            'profile_img' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'first_name.required' => 'Input first name harus diisi',
            'first_name.string' => 'Input first name harus diisi dengan string',
            'last_name.required' => 'Input last name harus diisi',
            'last_name.string' => 'Input last name harus diisi dengan string',
            'email.required' => 'Input email harus diisi',
            'email.email' => 'Input email harus diisi format @',
            'email.unique' => 'Email tersebut sudah tersedia',
            'password.min' => 'Input password minimal 8 karakter',
            'profile_img.image' => 'File harus berupa gambar.',
            'profile_img.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'profile_img.max' => 'Ukuran gambar maksimal 1MB.',
        ]);

        if ($validator->fails()) return redirect('/customer/edit-customer/' . $data->email)->withErrors($validator)->withInput();

        $nama_profile = $data->profile_img;
        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $nama_profile = 'profile_' . uniqid() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/profile', $nama_profile);
        }

        $data->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->filled('email') ? $request->input('email') : $data->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $data->password,
            'no_telp' => $request->no_telp,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'status' => $request->status,
            'profile_img' => $nama_profile,
        ]);

        return redirect('/customer')->with('success', 'Ubah data pelanggan berhasil');
    }

    public function customerDestroy($email)
    {
        $data = User::where('email', $email)->firstOrFail();
        $data->delete();
        return redirect('/customer')->with('success', 'Hapus data pelanggan berhasil');
    }

    public function faqCompanyIndex()
    {
        $data = FaqCompanyModel::all();
        return view('faq_company.index', compact(['data']));
    }

    public function faqCompanyAdd()
    {
        return view('faq_company.add');
    }

    public function faqCompanyStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'code_faq' => 'unique:faq_company,code_faq',
            'description' => 'required',
            'is_active' => 'required'
        ], [
            'title.required' => 'Input judul FAQ harus diisi',
            'code_faq.unique' => 'Kode FAQ tersebut sudah tersedia',
            'description.required' => 'Input deskripsi FAQ harus diisi',
            'is_active.required' => 'Input Status FAQ harus diisi',
        ]);

        if ($validator->fails()) return redirect('/faq-company/add-faq-company')->withErrors($validator)->withInput();

        FaqCompanyModel::create([
            'title' => $request->input('title'),
            'code_faq' => $request->input('code_faq'),
            'description' => $request->input('description'),
            'is_active' => $request->input('is_active')
        ]);

        return redirect('/faq-company')->with('success', 'Tambah data FAQ perusahaan berhasil');
    }

    public function faqCompanyEdit($code_faq)
    {
        $data = FaqCompanyModel::where('code_faq', $code_faq)->firstOrFail();
        return view('faq_company.edit', compact('data'));
    }

    public function faqCompanyUpdate(Request $request, $code_faq)
    {
        $data = FaqCompanyModel::where('code_faq', $code_faq)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
        ], [
            'title.required' => 'Input judul FAQ harus diisi',
            'description.required' => 'Input deskripsi FAQ harus diisi',
        ]);

        if ($validator->fails()) return redirect('/faq-company/edit-faq-company/' . strtolower($data->code_faq))->withErrors($validator)->withInput();

        $data->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect('/faq-company')->with('success', 'Ubah data FAQ perusahaan berhasil');
    }

    public function faqCompanyStatusUpdate(Request $request, $code_faq)
    {
        $data = FaqCompanyModel::where('code_faq', $code_faq)->firstOrFail();
        $data->update(['is_active' => $request->has('is_active') && $request->is_active == '1' ? 0 : 1]);
        return redirect('/faq-company')->with('success', 'Ubah status data FAQ perusahaan berhasil');
    }

    public function faqCompanyDestroy($code_faq)
    {
        $data = FaqCompanyModel::where('code_faq', $code_faq)->firstOrFail();
        $data->delete();
        return redirect('/faq-company')->with('success', 'Hapus data FAQ perusahaan berhasil');
    }

    public function galleryCompanyIndex()
    {
        $data = GalleryModel::all();
        return view('gallery.index', compact(['data']));
    }

    public function galleryCompanyAdd()
    {
        return view('gallery.add');
    }

    public function galleryCompanyStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'code_gallery' => 'unique:gallery,code_gallery',
            'is_active' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'title.required' => 'Input judul galeri harus diisi',
            'description.required' => 'Input deskripsi galeri harus diisi',
            'code_gallery.unique' => 'Kode galeri tersebut sudah tersedia',
            'is_active.required' => 'Input status galeri harus diisi',
            'image.required' => 'Input gambar galeri harus diisi',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 1MB.',
        ]);

        if ($validator->fails()) return redirect('/gallery-company/add-gallery-company')->withErrors($validator)->withInput();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name_gallery = 'gallery_' . uniqid() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/gallery', $name_gallery);
        }

        GalleryModel::create([
            'title' => $request->title,
            'code_gallery' => $request->code_gallery,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'image' => $name_gallery ?? 'not-photo.jpg'
        ]);

        return redirect('/gallery-company')->with('success', 'Tambah data galeri berhasil');
    }

    public function galleryCompanyEdit($code_gallery)
    {
        $data = GalleryModel::where('code_gallery', $code_gallery)->firstOrFail();
        return view('gallery.edit', compact('data'));
    }

    public function galleryCompanyUpdate(Request $request, $code_gallery)
    {
        $data = GalleryModel::where('code_gallery', $code_gallery)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'title.required' => 'Input judul galeri harus diisi',
            'description.required' => 'Input deskripsi galeri harus diisi',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'image.max' => 'Ukuran gambar maksimal 1MB.',
        ]);

        if ($validator->fails()) return redirect('/gallery-company/edit-gallery-company/' . strtolower($data->code_gallery))->withErrors($validator)->withInput();

        $name_gallery = $data->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name_gallery = 'gallery_' . uniqid() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/gallery', $name_gallery);
        }

        $data->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $name_gallery
        ]);

        return redirect('/gallery-company')->with('success', 'Ubah data galeri berhasil');
    }

    public function galleryCompanyStatusUpdate(Request $request, $code_gallery)
    {
        $data = GalleryModel::where('code_gallery', $code_gallery)->firstOrFail();
        $data->update(['is_active' => $request->has('is_active') && $request->is_active == '1' ? 0 : 1]);
        return redirect('/gallery-company')->with('success', 'Ubah status data galeri berhasil');
    }

    public function galleryCompanyDestroy($code_gallery)
    {
        $data = GalleryModel::where('code_gallery', $code_gallery)->firstOrFail();
        $data->delete();
        return redirect('/gallery-company')->with('success', 'Hapus data galeri berhasil');
    }
}