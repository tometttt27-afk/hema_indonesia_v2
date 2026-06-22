@extends('template.layout-main')
@section('title_web', 'Profil Saya | Hema.Indonesia')
@section('content-main')

<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li>Profil</li>
        </ol>
        <h2>Profil <span style="color:#b17457;">Saya</span></h2>
        <p>Kelola informasi akun dan kata sandi Anda</p>
    </div>
</div>

<section class="container py-14">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- ── Avatar & quick links ── --}}
        <div class="lg:col-span-1">

            {{-- Avatar card --}}
            <div class="profile-avatar-card">
                <img src="{{ asset('uploads/profile/'.($data->profile_img ?? 'default_profile.jpg')) }}"
                     alt="profil">
                <h3>{{ $data->first_name }} {{ $data->last_name }}</h3>
                <p>{{ $data->email }}</p>
                <span class="mt-2 inline-block text-xs px-3 py-1 rounded-full capitalize"
                      style="background:rgba(177,116,87,.1);color:#b17457;font-weight:600;">
                    {{ $data->role }}
                </span>
            </div>

            {{-- Quick links — FIXED: sintaks @foreach yang benar --}}
            <div class="profile-form-card mt-5">
                <h3 style="font-size:13.5px;">Menu Cepat</h3>

                @php
                    $quickLinks = [
                        ['/orders',   'fas fa-bag-shopping',   'Pesanan Saya'],
                        ['/wishlist', 'far fa-heart',           'Wishlist'],
                        ['/cart',     'fas fa-cart-shopping',   'Keranjang'],
                    ];
                @endphp

                @foreach($quickLinks as $ql)
                <a href="{{ url($ql[0]) }}"
                   class="flex items-center gap-3 py-2.5 px-3 rounded-lg text-sm font-medium transition-colors"
                   style="color:#374151;text-decoration:none;margin-bottom:2px;"
                   onmouseover="this.style.color='#b17457';this.style.background='rgba(177,116,87,.06)';"
                   onmouseout="this.style.color='#374151';this.style.background='transparent';">
                    <i class="{{ $ql[1] }}" style="color:#b17457;width:16px;text-align:center;"></i>
                    {{ $ql[2] }}
                    <i class="fas fa-chevron-right text-xs ms-auto" style="color:#d1c4bc;"></i>
                </a>
                @endforeach
            </div>
        </div>

        {{-- ── Form panels ── --}}
        <div class="lg:col-span-2 flex flex-col gap-6">

            {{-- Informasi Akun --}}
            <div class="profile-form-card">
                <h3>
                    <i class="fas fa-user me-2" style="color:#b17457;font-size:15px;"></i>
                    Informasi Akun
                </h3>
                <form action="{{ route('profileUpdate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label-brand">Nama Depan</label>
                            <input type="text" name="first_name"
                                   value="{{ old('first_name', $data->first_name) }}"
                                   class="input-brand" autocomplete="given-name">
                        </div>
                        <div>
                            <label class="label-brand">Nama Belakang</label>
                            <input type="text" name="last_name"
                                   value="{{ old('last_name', $data->last_name) }}"
                                   class="input-brand" autocomplete="family-name">
                        </div>
                        <div>
                            <label class="label-brand">Email</label>
                            <input type="email" name="email"
                                   value="{{ old('email', $data->email) }}"
                                   class="input-brand" autocomplete="email">
                        </div>
                        <div>
                            <label class="label-brand">No. Telepon</label>
                            <input type="text" name="no_telp"
                                   value="{{ old('no_telp', $data->no_telp) }}"
                                   class="input-brand" autocomplete="tel">
                        </div>
                        <div>
                            <label class="label-brand">Jenis Kelamin</label>
                            <select name="gender" class="input-brand">
                                <option value="">-- Pilih --</option>
                                <option value="male"
                                    {{ $data->gender === 'male' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="female"
                                    {{ $data->gender === 'female' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="label-brand">Umur</label>
                            <input type="number" name="age" min="1" max="120"
                                   value="{{ old('age', $data->age) }}"
                                   class="input-brand">
                        </div>
                        <div class="md:col-span-2">
                            <label class="label-brand">Alamat Lengkap</label>
                            <textarea name="address" rows="3"
                                      class="input-brand">{{ old('address', $data->address) }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="label-brand">Foto Profil</label>
                            @if($data->profile_img && $data->profile_img !== 'default_profile.jpg')
                                <div class="mb-2">
                                    <img src="{{ asset('uploads/profile/'.$data->profile_img) }}"
                                         class="rounded-full object-cover"
                                         style="width:56px;height:56px;border:2px solid #ede3db;"
                                         alt="foto profil">
                                </div>
                            @endif
                            <input type="file" name="profile_img" accept="image/jpeg,image/png,image/jpg"
                                   class="input-brand">
                            <p style="font-size:11.5px;color:#a89080;margin-top:4px;">
                                Format: JPG, PNG. Maks 1 MB.
                            </p>
                        </div>
                    </div>
                    <button type="submit" class="btn-brand mt-5 px-7 py-3 text-sm rounded-xl">
                        <i class="fas fa-check text-xs"></i> Simpan Perubahan
                    </button>
                </form>
            </div>

            {{-- Ubah Kata Sandi --}}
            <div class="profile-form-card">
                <h3>
                    <i class="fas fa-shield-halved me-2" style="color:#b17457;font-size:15px;"></i>
                    Ubah Kata Sandi
                </h3>
                <form action="{{ route('profilePasswordUpdate') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="label-brand">Password Lama</label>
                            <input type="password" name="current_password"
                                   class="input-brand" autocomplete="current-password">
                        </div>
                        <div>
                            <label class="label-brand">Password Baru</label>
                            <input type="password" name="password"
                                   class="input-brand" autocomplete="new-password">
                        </div>
                        <div>
                            <label class="label-brand">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation"
                                   class="input-brand" autocomplete="new-password">
                        </div>
                    </div>
                    <p style="font-size:11.5px;color:#a89080;margin-top:8px;">
                        Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.
                    </p>
                    <button type="submit" class="btn-brand mt-4 px-7 py-3 text-sm rounded-xl">
                        <i class="fas fa-key text-xs"></i> Ubah Password
                    </button>
                </form>
            </div>

        </div>{{-- /col-span-2 --}}
    </div>{{-- /grid --}}
</section>

@endsection
