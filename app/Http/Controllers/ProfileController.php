<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        if ($data->role == 'admin') {
            return view('profile.admin', compact('data'));
        }
        return view('profile.customer', compact('data'));
    }

    public function update(Request $request)
    {
        $data = Auth::user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $data->id,
            'profile_img' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'first_name.required' => 'Input first name harus diisi',
            'first_name.string' => 'Input first name harus diisi dengan string',
            'last_name.required' => 'Input last name harus diisi',
            'last_name.string' => 'Input last name harus diisi dengan string',
            'email.required' => 'Input email harus diisi',
            'email.email' => 'Input email harus diisi format @',
            'email.unique' => 'Email tersebut sudah tersedia',
            'profile_img.image' => 'File harus berupa gambar.',
            'profile_img.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'profile_img.max' => 'Ukuran gambar maksimal 1MB.',
        ]);

        if ($validator->fails()) return redirect('/profile')->withErrors($validator)->withInput();

        $nama_profile = $data->profile_img;
        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $nama_profile = 'profile_' . uniqid() . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/profile', $nama_profile);
        }

        $data->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,
            'profile_img' => $nama_profile ?? 'default_profile.jpg',
        ]);

        return redirect('/profile')->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $data = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama harus diisi',
            'password.required' => 'Password baru harus diisi',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok',
        ]);

        if ($validator->fails()) return redirect('/profile')->withErrors($validator)->withInput();

        if (!Hash::check($request->current_password, $data->password)) {
            Session::flash('error', 'Password lama anda salah');
            return redirect('/profile');
        }

        $data->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect('/profile')->with('success', 'Password berhasil diubah');
    }
}
