@extends('template.layout-admin')
@section('title_web', 'Tambah Pelanggan | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Tambah Pelanggan</h4>
        <h6>Menambahkan akun pelanggan baru</h6>
    </div>
    <a href="{{ url('/customer') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row justify-content-center">
<div class="col-lg-9">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="bi bi-person-plus me-2" style="color:#b17457;"></i>Form Tambah Pelanggan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('customerPost') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6"><div class="form-group"><label>Nama Depan <span class="text-danger">*</span></label><input type="text" value="{{ old('first_name') }}" name="first_name" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Nama Belakang</label><input type="text" value="{{ old('last_name') }}" name="last_name" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Email <span class="text-danger">*</span></label><input type="text" value="{{ old('email') }}" name="email" autocomplete="off"></div></div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" name="password" class="pass-input" autocomplete="off">
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"><div class="form-group"><label>No. Telepon</label><input type="number" value="{{ old('no_telp') }}" name="no_telp" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Jenis Kelamin</label><select class="select" name="gender"><option value="">-- Pilih --</option><option value="male">Laki-laki</option><option value="female">Perempuan</option></select></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Umur</label><input type="number" value="{{ old('age') }}" name="age" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Status Akun</label><select class="select" name="status"><option value="">-- Pilih Status --</option><option value="active">Aktif</option><option value="inactive">Tidak Aktif</option><option value="banned">Banned</option></select></div></div>
                <div class="col-12"><div class="form-group"><label>Alamat</label><textarea name="address" rows="3" class="form-control">{{ old('address') }}</textarea></div></div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Foto Profil</label>
                        <div class="image-upload">
                            <input name="profile_img" id="file_drop" type="file" onchange="updateFileName()">
                            <div class="image-uploads" id="upload-area">
                                <img src="{{ asset('admin/img/icons/upload.svg') }}" alt="Upload" style="width:40px;opacity:.5;">
                                <h4 id="file-name" style="font-size:12.5px;color:#7a6255;margin-top:6px;">Drag & drop atau klik</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex gap-2 mt-1">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                    <button type="reset" class="btn btn-cancel"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection
