@extends('template.layout-admin')
@section('title_web', 'Ubah Pelanggan | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <nav class="breadcrumb-admin">
            <a href="{{ url('/customer') }}">Pelanggan</a>
            <span class="sep">/</span>
            <span class="current">Ubah: {{ $data->first_name }}</span>
        </nav>
        <h4>Ubah Data Pelanggan</h4>
        <h6>Mengubah informasi akun pelanggan</h6>
    </div>
    <a href="{{ url('/customer') }}" class="btn btn-secondary btn-cancel-nav" data-form="form-edit-customer">
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
            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
        </svg>
        <h5 class="card-title mb-0">Form Ubah Pelanggan</h5>
        <span class="badge badge-brand">{{ $data->email }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('customerPut', $data->email) }}" method="post" id="form-edit-customer">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama Depan <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('first_name',$data->first_name) }}" name="first_name"
                               autocomplete="off" placeholder="Nama depan">
                        @error('first_name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama Belakang</label>
                        <input type="text" value="{{ old('last_name',$data->last_name) }}" name="last_name"
                               autocomplete="off" placeholder="Nama belakang">
                        @error('last_name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" value="{{ old('email',$data->email) }}" name="email"
                               autocomplete="off" placeholder="email@contoh.com">
                        @error('email')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="tel" value="{{ old('no_telp',$data->no_telp) }}" name="no_telp"
                               autocomplete="off" placeholder="08123456789">
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
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="number" value="{{ old('age',$data->age) }}" name="age"
                               autocomplete="off" placeholder="Umur" min="1" max="120">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Status Akun</label>
                        <select class="select" name="status">
                            <option value="">-- Pilih Status --</option>
                            <option value="active"   {{ old('status',$data->status)==='active'   ?'selected':'' }}>Aktif</option>
                            <option value="inactive" {{ old('status',$data->status)==='inactive' ?'selected':'' }}>Tidak Aktif</option>
                            <option value="banned"   {{ old('status',$data->status)==='banned'   ?'selected':'' }}>Banned</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="address" rows="3" class="form-control"
                                  placeholder="Alamat lengkap pelanggan">{{ old('address',$data->address) }}</textarea>
                    </div>
                </div>

                {{-- Info: password & foto hanya bisa diubah customer sendiri --}}
                <div class="col-12">
                    <div class="alert alert-info d-flex align-items-center gap-2 mb-4">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                        <span><strong>Password</strong> dan <strong>Foto Profil</strong> hanya dapat diubah oleh pelanggan sendiri melalui halaman profil mereka.</span>
                    </div>
                </div>

                <div class="col-12 d-flex gap-2 mt-1">
                    <button type="submit" class="btn btn-primary">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                        Simpan Perubahan
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
