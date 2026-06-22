@extends('template.layout-admin')
@section('title_web', 'Tambah Galeri | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title"><h4>Tambah Galeri</h4><h6>Menambahkan foto galeri baru</h6></div>
    <a href="{{ url('/gallery-company') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row justify-content-center"><div class="col-lg-8">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="bi bi-plus-circle me-2" style="color:#b17457;"></i>Form Tambah Galeri</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('galleryCompanyPost') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12"><div class="form-group"><label>Judul Galeri <span class="text-danger">*</span></label><input type="text" value="{{ old('title') }}" name="title" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Kode Galeri</label><input type="text" readonly name="code_gallery" id="code_gallery" style="background:#f5f5f5;cursor:not-allowed;"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Status <span class="text-danger">*</span></label><select class="select" name="is_active"><option value="">-- Pilih Status --</option><option value="1">Aktif</option><option value="0">Tidak Aktif</option></select></div></div>
                <div class="col-12"><div class="form-group"><label>Gambar <span class="text-danger">*</span></label><div class="image-upload"><input name="image" id="file_drop" type="file" onchange="updateFileName()"><div class="image-uploads" id="upload-area"><img src="{{ asset('admin/img/icons/upload.svg') }}" alt="Upload" style="width:44px;opacity:.5;"><h4 id="file-name" style="font-size:13px;color:#7a6255;margin-top:8px;">Drag & drop atau klik</h4></div></div></div></div>
                <div class="col-12"><div class="form-group"><label>Deskripsi</label><textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea></div></div>
                <div class="col-12 d-flex gap-2 mt-1">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                    <button type="reset" class="btn btn-cancel"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div></div>

@endsection
