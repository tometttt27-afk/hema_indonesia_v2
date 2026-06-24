@extends('template.layout-admin')
@section('title_web', 'Profil Saya | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Profil Saya</h4>
        <h6>Kelola informasi akun dan kata sandi</h6>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger d-flex align-items-start gap-3 mb-4">
    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" class="flex-shrink-0 mt-1" style="color:var(--red);">
        <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
    </svg>
    <div>
        <strong>Terdapat {{ $errors->count() }} kesalahan:</strong>
        <ul class="mb-0 mt-1 ps-3">
            @foreach($errors->all() as $e)<li style="font-size:13px;">{{ $e }}</li>@endforeach
        </ul>
    </div>
</div>
@endif

<div class="row g-3">

    {{-- Avatar card --}}
    <div class="col-lg-3">
        <div class="card text-center mb-0">
            <div class="card-body py-4">
                <img class="rounded-circle mb-3"
                     src="{{ asset('uploads/profile/'.($data->profile_img ?? 'default_profile.jpg')) }}"
                     alt="Foto profil {{ $data->first_name }}"
                     style="width:110px;height:110px;object-fit:cover;">
                <h5 class="fw-700 mb-1" style="font-size:16px;">{{ $data->first_name }} {{ $data->last_name }}</h5>
                <p class="text-muted-brand mb-2" style="font-size:13px;">{{ $data->email }}</p>
                <span class="badge badge-brand" style="text-transform:capitalize;">{{ $data->role }}</span>
            </div>
        </div>
    </div>

    <div class="col-lg-9">

        {{-- Informasi Akun --}}
        <div class="card mb-3">
            <div class="card-header">
                {{-- icon person siluet --}}
                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                    <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-5.33 0-8 2.67-8 4v1h16v-1c0-1.33-2.67-4-8-4z"/>
                </svg>
                <h5 class="card-title mb-0">Informasi Akun</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profileUpdate') }}" method="post" enctype="multipart/form-data"
                      id="form-profile-info">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Depan</label>
                                <input type="text" name="first_name"
                                       value="{{ old('first_name', $data->first_name) }}"
                                       placeholder="Nama depan" autocomplete="off">
                                @error('first_name')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Belakang</label>
                                <input type="text" name="last_name"
                                       value="{{ old('last_name', $data->last_name) }}"
                                       placeholder="Nama belakang" autocomplete="off">
                                @error('last_name')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email"
                                       value="{{ old('email', $data->email) }}"
                                       placeholder="email@contoh.com" autocomplete="off">
                                @error('email')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>No. Telepon</label>
                                <input type="tel" name="no_telp"
                                       value="{{ old('no_telp', $data->no_telp) }}"
                                       placeholder="08123456789" autocomplete="off">
                                @error('no_telp')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="select" name="gender">
                                    <option value="">-- Pilih --</option>
                                    <option value="male"   {{ old('gender',$data->gender)==='male'   ?'selected':'' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender',$data->gender)==='female' ?'selected':'' }}>Perempuan</option>
                                </select>
                                @error('gender')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Umur</label>
                                <input type="number" name="age"
                                       value="{{ old('age', $data->age) }}"
                                       placeholder="Umur" min="1" max="120" autocomplete="off">
                                @error('age')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" rows="3" class="form-control"
                                          placeholder="Alamat lengkap">{{ old('address', $data->address) }}</textarea>
                                @error('address')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Foto Profil</label>
                                <input type="file" name="profile_img" class="form-control" accept="image/*">
                                @error('profile_img')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Ubah Kata Sandi --}}
        <div class="card">
            <div class="card-header">
                {{-- icon shield siluet --}}
                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                </svg>
                <h5 class="card-title mb-0">Ubah Kata Sandi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profilePasswordUpdate') }}" method="post" id="form-change-password">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Password Lama <span class="text-danger">*</span></label>
                                <input type="password" name="current_password"
                                       placeholder="Masukkan password lama" autocomplete="off">
                                @error('current_password')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Password Baru <span class="text-danger">*</span></label>
                                <input type="password" name="password"
                                       placeholder="Min. 8 karakter" autocomplete="off">
                                @error('password')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation"
                                       placeholder="Ulangi password baru" autocomplete="off">
                                @error('password_confirmation')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                                </svg>
                                Ubah Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
