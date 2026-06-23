@extends('template.layout-admin')
@section('title_web', 'Tambah Pelanggan | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <nav class="breadcrumb-admin">
            <a href="{{ url('/customer') }}">Pelanggan</a>
            <span class="sep">/</span>
            <span class="current">Tambah</span>
        </nav>
        <h4>Tambah Pelanggan</h4>
        <h6>Menambahkan akun pelanggan baru</h6>
    </div>
    <a href="{{ url('/customer') }}" class="btn btn-secondary btn-cancel-nav" data-form="form-add-customer">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
        Kembali
    </a>
</div>

@if($errors->any())
<div class="alert alert-danger d-flex align-items-start gap-3 mb-4">
    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" class="flex-shrink-0 mt-1" style="color:var(--red);"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
    <div><strong>Terdapat {{ $errors->count() }} kesalahan:</strong>
        <ul class="mb-0 mt-1 ps-3">@foreach($errors->all() as $e)<li style="font-size:13px;">{{ $e }}</li>@endforeach</ul>
    </div>
</div>
@endif

<div class="row justify-content-center">
<div class="col-lg-9">
<div class="card">
    <div class="card-header">
        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
            <path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
        </svg>
        <h5 class="card-title mb-0">Form Tambah Pelanggan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('customerPost') }}" method="post" enctype="multipart/form-data" id="form-add-customer">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama Depan <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('first_name') }}" name="first_name"
                               autocomplete="off" placeholder="Contoh: Budi">
                        @error('first_name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama Belakang</label>
                        <input type="text" value="{{ old('last_name') }}" name="last_name"
                               autocomplete="off" placeholder="Contoh: Santoso">
                        @error('last_name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" value="{{ old('email') }}" name="email"
                               autocomplete="off" placeholder="contoh@email.com">
                        @error('email')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password" class="pass-input"
                                   autocomplete="off" placeholder="Min. 8 karakter">
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                        @error('password')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="tel" value="{{ old('no_telp') }}" name="no_telp"
                               autocomplete="off" placeholder="Contoh: 08123456789">
                        @error('no_telp')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="select" name="gender">
                            <option value="">-- Pilih --</option>
                            <option value="male"   {{ old('gender')==='male'   ?'selected':'' }}>Laki-laki</option>
                            <option value="female" {{ old('gender')==='female' ?'selected':'' }}>Perempuan</option>
                        </select>
                        @error('gender')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="number" value="{{ old('age') }}" name="age"
                               autocomplete="off" placeholder="Contoh: 25" min="1" max="120">
                        @error('age')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Status Akun</label>
                        <select class="select" name="status">
                            <option value="">-- Pilih Status --</option>
                            <option value="active"   {{ old('status')==='active'   ?'selected':'' }}>Aktif</option>
                            <option value="inactive" {{ old('status')==='inactive' ?'selected':'' }}>Tidak Aktif</option>
                            <option value="banned"   {{ old('status')==='banned'   ?'selected':'' }}>Banned</option>
                        </select>
                        @error('status')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="address" rows="3" class="form-control"
                                  placeholder="Jalan, kelurahan, kecamatan, kota, kode pos">{{ old('address') }}</textarea>
                        @error('address')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Foto Profil</label>
                        <div class="image-upload">
                            <input name="profile_img" id="file_drop" type="file" onchange="updateFileName()">
                            <div class="image-uploads" id="upload-area">
                                <svg width="36" height="36" fill="currentColor" viewBox="0 0 24 24"
                                     style="color:var(--br-lt);opacity:.6;margin:0 auto 6px;">
                                    <path d="M19.35 10.04A7.49 7.49 0 0012 4C9.11 4 6.6 5.64 5.35 8.04A5.994 5.994 0 000 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                                </svg>
                                <h4 id="file-name" style="font-size:12.5px;color:var(--tx-3);margin-top:0;">Drag &amp; drop atau klik</h4>
                            </div>
                        </div>
                        @error('profile_img')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-12 d-flex gap-2 mt-1">
                    <button type="submit" class="btn btn-primary">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                        Simpan
                    </button>
                    <button type="reset" class="btn btn-cancel">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/></svg>
                        Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
