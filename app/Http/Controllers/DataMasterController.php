<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
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
        ]);

        if ($validator->fails()) return redirect('/customer/add-customer')->withErrors($validator)->withInput();

        $nama_profile = 'default_profile.jpg';
        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $nama_profile = 'profile_' . uniqid() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/profile', $nama_profile);

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
                'profile_img' => $nama_profile
            ]);
        } else {
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
                'profile_img' => 'default_profile.jpg'
            ]);
        }

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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'first_name.required' => 'Input first name harus diisi',
            'first_name.string' => 'Input first name harus diisi dengan string',
            'last_name.required' => 'Input last name harus diisi',
            'last_name.string' => 'Input last name harus diisi dengan string',
            'email.required' => 'Input email harus diisi',
            'email.email' => 'Input email harus diisi format @',
            'email.unique' => 'Email tersebut sudah tersedia',
            'password.required' => 'Input password harus diisi',
            'password.min' => 'Input password minimal 8 karakter'
        ]);

        if ($validator->fails()) return redirect('/customer/edit-customer/' . strtolower($data->email))->withErrors($validator)->withInput();

        $data->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'no_telp' => $request->no_telp,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'profile_img' => $request->profile_img,
            'status' => $request->status
        ]);

        return redirect('/customer')->with('success', 'Ubah data pelanggan berhasil');
    }

    public function customerDestroy($email)
    {
        $data = User::where('email', $email)->firstOrFail();
        $data->delete();
        return redirect('/categories')->with('success', 'Hapus data pelanggan berhasil');
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
}
