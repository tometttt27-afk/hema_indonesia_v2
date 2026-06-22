@extends('template.layout-main')
@section('title_web', 'Profil Saya | Hema.Indonesia')
@section('content-main')
    <div class="header-hero bg-[#f5f5f5]">
        <div class="container pt-10 pb-11">
            <div class="block">
                <nav aria-label="breadcrumb" class="w-full">
                    <ol class="flex w-full flex-wrap items-center mb-2">
                        <li
                            class="flex cursor-pointer items-center text-sm text-gray-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="{{ url('/') }}">Beranda</a>
                            <span class="pointer-events-none mx-2 text-slate-800">/</span>
                        </li>
                        <li
                            class="flex cursor-pointer items-center text-sm text-gray-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="{{ url('/profile') }}">Profil</a>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-[20px] md:text-2xl font-bold">Profil <span class="text-primary">Saya</span></h2>
                <p class="text-gray-500">Kelola informasi akun dan kata sandi anda</p>
            </div>
        </div>
    </div>

    <section class="container py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="border border-gray-200 rounded p-6 flex flex-col items-center text-center">
                    <img class="w-32 h-32 object-cover rounded-full border"
                        src="{{ asset('uploads/profile/' . ($data->profile_img ?? 'default_profile.jpg')) }}"
                        alt="profile">
                    <h3 class="font-semibold mt-4 text-lg">{{ $data->first_name }} {{ $data->last_name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $data->email }}</p>
                    <span
                        class="mt-2 inline-block text-xs px-3 py-1 rounded-full bg-gray-100 capitalize">{{ $data->role }}</span>
                </div>
            </div>

            <div class="lg:col-span-2 flex flex-col gap-8">
                <div class="border border-gray-200 rounded p-6">
                    <h3 class="font-semibold text-lg mb-4">Informasi Akun</h3>
                    <form action="{{ route('profileUpdate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="block mb-1 text-sm text-gray-800">Nama Depan</label>
                                <input type="text" name="first_name"
                                    value="{{ old('first_name', $data->first_name) }}"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none text-sm">
                            </div>
                            <div class="form-group">
                                <label class="block mb-1 text-sm text-gray-800">Nama Belakang</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $data->last_name) }}"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none text-sm">
                            </div>
                            <div class="form-group">
                                <label class="block mb-1 text-sm text-gray-800">Email</label>
                                <input type="text" name="email" value="{{ old('email', $data->email) }}"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none text-sm">
                            </div>
                            <div class="form-group">
                                <label class="block mb-1 text-sm text-gray-800">No. Telepon</label>
                                <input type="text" name="no_telp" value="{{ old('no_telp', $data->no_telp) }}"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none text-sm">
                            </div>
                            <div class="form-group">
                                <label class="block mb-1 text-sm text-gray-800">Jenis Kelamin</label>
                                <select name="gender"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none text-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="male" {{ $data->gender == 'male' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="female" {{ $data->gender == 'female' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="block mb-1 text-sm text-gray-800">Umur</label>
                                <input type="number" name="age" value="{{ old('age', $data->age) }}"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none text-sm">
                            </div>
                            <div class="form-group md:col-span-2">
                                <label class="block mb-1 text-sm text-gray-800">Alamat</label>
                                <textarea name="address" rows="3"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none text-sm">{{ old('address', $data->address) }}</textarea>
                            </div>
                            <div class="form-group md:col-span-2">
                                <label class="block mb-1 text-sm text-gray-800">Foto Profil</label>
                                <input type="file" name="profile_img" accept="image/*"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[8px] outline-none text-sm">
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-primary to-secondary hover:opacity-90 rounded-sm font-medium tracking-widest inline-block mt-4 px-6 py-[10px] outline-none text-white text-sm">Simpan
                            Perubahan</button>
                    </form>
                </div>

                <div class="border border-gray-200 rounded p-6">
                    <h3 class="font-semibold text-lg mb-4">Ubah Kata Sandi</h3>
                    <form action="{{ route('profilePasswordUpdate') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-4">
                            <div class="form-group">
                                <label class="block mb-1 text-sm text-gray-800">Password Lama</label>
                                <input type="password" name="current_password"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none text-sm">
                            </div>
                            <div class="form-group">
                                <label class="block mb-1 text-sm text-gray-800">Password Baru</label>
                                <input type="password" name="password"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none text-sm">
                            </div>
                            <div class="form-group">
                                <label class="block mb-1 text-sm text-gray-800">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none text-sm">
                            </div>
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-primary to-secondary hover:opacity-90 rounded-sm font-medium tracking-widest inline-block mt-4 px-6 py-[10px] outline-none text-white text-sm">Ubah
                            Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
