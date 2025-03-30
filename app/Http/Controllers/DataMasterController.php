<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
use App\Models\FaqCompanyModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DataMasterController extends Controller
{
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
            'date_birth' => $request->date_birth,
            'no_telp' => $request->no_telp,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'status' => $request->status,
            'role' => 'customer',
            'profile_img' => $nama_profile ?? 'default_profile.jpg'
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

        if ($validator->fails()) return redirect('/customer/edit-customer/' . strtolower($data->email))->withErrors($validator)->withInput();

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
            'date_birth' => $request->date_birth,
            'no_telp' => $request->no_telp,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'status' => $request->status,
            'profile_img' => $nama_profile
        ]);

        return redirect('/customer')->with('success', 'Ubah data pelanggan berhasil');
    }

    public function customerDestroy($email)
    {
        $data = User::where('email', $email)->firstOrFail();
        $data->delete();
        return redirect('/customer')->with('success', 'Hapus data pelanggan berhasil');
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

        Session::flash('success', 'Tambah kategori produk berhasil');
        return redirect('/categories');
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

        Session::flash('success', 'Ubah kategori produk berhasil');
        return redirect('/categories');
    }

    public function categoriesDestroy($category_code)
    {
        $data = CategoriesModel::where('category_code', $category_code)->firstOrFail();
        $data->delete();
        Session::flash('success', 'Hapus kategori produk berhasil');
        return redirect('/categories');
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
}
