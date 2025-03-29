@extends('template.layout-admin')
@section('title_web', 'Tambah Data Pelanggan | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Tambah Data Pelanggan</h4>
            <h6>Menambahkan data baru pelanggan</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('customerPost') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('first_name') }}" name="first_name" id="first_name"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('last_name') }}" name="last_name" id="last_name"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('email') }}" name="email" id="email"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <div class="pass-group">
                                <input type="password" value="{{ old('password') }}" name="password" id="password"
                                    autocomplete="off" class="pass-input">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="number" value="{{ old('no_telp') }}" name="no_telp" id="no_telp"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="select" name="gender" id="gender">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="male">Pria | Laki-laki</option>
                                <option value="female">Wanita | Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Umur | Usia</label>
                            <input type="number" value="{{ old('age') }}" name="age" id="age"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status Akun</label>
                            <select class="select" name="status" id="status">
                                <option value="">-- Pilih Status Akun --</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                                <option value="banned">Banned</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Profile</label>
                            <input type="file" value="{{ old('profile_img') }}" name="profile_img" id="profile_img"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ old('address') }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Kirim</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>
@endsection
