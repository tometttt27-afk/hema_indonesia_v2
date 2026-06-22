@extends('template.layout-admin')
@section('title_web', 'Ubah Pelanggan | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Ubah Data Pelanggan</h4>
        <h6>Mengubah informasi akun pelanggan</h6>
    </div>
    <a href="{{ url('/customer') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row justify-content-center">
<div class="col-lg-9">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="bi bi-person-gear me-2" style="color:#b17457;"></i>Form Ubah Pelanggan</h5>
        <span class="badge badge-brand">{{ $data->email }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('customerPut',$data->email) }}" method="post">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-lg-6"><div class="form-group"><label>Nama Depan <span class="text-danger">*</span></label><input type="text" value="{{ $data->first_name }}" name="first_name" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Nama Belakang</label><input type="text" value="{{ $data->last_name }}" name="last_name" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Email <span class="text-danger">*</span></label><input type="text" value="{{ $data->email }}" name="email" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>No. Telepon</label><input type="number" value="{{ $data->no_telp }}" name="no_telp" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Jenis Kelamin</label><select class="select" name="gender"><option value="">-- Pilih --</option><option value="male" {{ $data->gender=='male'?'selected':'' }}>Laki-laki</option><option value="female" {{ $data->gender=='female'?'selected':'' }}>Perempuan</option></select></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Umur</label><input type="number" value="{{ $data->age }}" name="age" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Status Akun</label><select class="select" name="status"><option value="">-- Pilih Status --</option><option value="active" {{ $data->status=='active'?'selected':'' }}>Aktif</option><option value="inactive" {{ $data->status=='inactive'?'selected':'' }}>Tidak Aktif</option><option value="banned" {{ $data->status=='banned'?'selected':'' }}>Banned</option></select></div></div>
                <div class="col-12"><div class="form-group"><label>Alamat</label><textarea name="address" rows="3" class="form-control">{{ $data->address }}</textarea></div></div>

                {{-- INFO: password & foto profil hanya bisa diubah oleh customer sendiri --}}
                <div class="col-12">
                    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:6px;
                                padding:10px 14px;font-size:12.5px;color:#1e40af;
                                display:flex;align-items:center;gap:8px;margin-bottom:16px;">
                        <i class="bi bi-info-circle-fill flex-shrink-0"></i>
                        <span>
                            <strong>Password</strong> dan <strong>Foto Profil</strong>
                            hanya dapat diubah oleh pelanggan sendiri melalui halaman profil mereka.
                        </span>
                    </div>
                </div>

                <div class="col-12 d-flex gap-2 mt-1">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
                    <button type="reset" class="btn btn-cancel"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection
