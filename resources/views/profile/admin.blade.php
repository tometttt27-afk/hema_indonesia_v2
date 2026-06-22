@extends('template.layout-admin')
@section('title_web', 'Profil Saya | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title"><h4>Profil Saya</h4><h6>Kelola informasi akun dan kata sandi</h6></div>
</div>

<div class="row g-3">
    {{-- Avatar card --}}
    <div class="col-lg-3">
        <div class="card text-center mb-0">
            <div class="card-body py-4">
                <img class="rounded-circle mb-3"
                    src="{{ asset('uploads/profile/'.($data->profile_img??'default_profile.jpg')) }}"
                    alt="profile"
                    style="width:110px;height:110px;object-fit:cover;border:3px solid #ede3db;">
                <h5 class="fw-700 mb-1" style="font-size:16px;">{{ $data->first_name }} {{ $data->last_name }}</h5>
                <p class="text-muted-brand mb-2" style="font-size:13px;">{{ $data->email }}</p>
                <span class="badge badge-brand" style="text-transform:capitalize;">{{ $data->role }}</span>
            </div>
        </div>
    </div>

    <div class="col-lg-9">
        {{-- Account info --}}
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="bi bi-person me-2" style="color:#b17457;"></i>Informasi Akun</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profileUpdate') }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Nama Depan</label><input type="text" name="first_name" value="{{ old('first_name',$data->first_name) }}" autocomplete="off"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Nama Belakang</label><input type="text" name="last_name" value="{{ old('last_name',$data->last_name) }}" autocomplete="off"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Email</label><input type="text" name="email" value="{{ old('email',$data->email) }}" autocomplete="off"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>No. Telepon</label><input type="text" name="no_telp" value="{{ old('no_telp',$data->no_telp) }}" autocomplete="off"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Jenis Kelamin</label><select class="select" name="gender"><option value="">-- Pilih --</option><option value="male" {{ $data->gender=='male'?'selected':'' }}>Laki-laki</option><option value="female" {{ $data->gender=='female'?'selected':'' }}>Perempuan</option></select></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Umur</label><input type="number" name="age" value="{{ old('age',$data->age) }}" autocomplete="off"></div></div>
                        <div class="col-12"><div class="form-group"><label>Alamat</label><textarea name="address" rows="3" class="form-control">{{ old('address',$data->address) }}</textarea></div></div>
                        <div class="col-12"><div class="form-group"><label>Foto Profil</label><input type="file" name="profile_img" class="form-control" accept="image/*"></div></div>
                        <div class="col-12"><button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button></div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Password --}}
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="bi bi-shield-lock me-2" style="color:#b17457;"></i>Ubah Kata Sandi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profilePasswordUpdate') }}" method="post">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-12"><div class="form-group"><label>Password Lama</label><input type="password" name="current_password" autocomplete="off"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Password Baru</label><input type="password" name="password" autocomplete="off"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Konfirmasi Password Baru</label><input type="password" name="password_confirmation" autocomplete="off"></div></div>
                        <div class="col-12"><button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Ubah Password</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
