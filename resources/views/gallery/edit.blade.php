@extends('template.layout-admin')
@section('title_web', 'Ubah Galeri | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title"><h4>Ubah Galeri</h4><h6>Mengubah data galeri</h6></div>
    <a href="{{ url('/gallery-company') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row justify-content-center"><div class="col-lg-8">
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="bi bi-pencil-square me-2" style="color:#b17457;"></i>Form Ubah Galeri</h5>
        <span class="badge badge-brand">{{ $data->code_gallery }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('galleryCompanyPut',$data->code_gallery) }}" method="post" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-lg-6"><div class="form-group"><label>Judul Galeri <span class="text-danger">*</span></label><input type="text" value="{{ $data->title }}" name="title" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Kode Galeri</label><input type="text" value="{{ $data->code_gallery }}" readonly name="code_gallery" style="background:#f5f5f5;cursor:not-allowed;"></div></div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Gambar Baru (opsional)</label>
                        @if($data->image)
                            <img src="{{ asset('uploads/gallery/'.$data->image) }}" class="rounded d-block mb-2" style="max-height:120px;object-fit:cover;border:1.5px solid #ede3db;">
                        @endif
                        <div class="image-upload">
                            <input name="image" id="file_drop" type="file" onchange="updateFileName()">
                            <div class="image-uploads" id="upload-area">
                                <img src="{{ asset('admin/img/icons/upload.svg') }}" alt="Upload" style="width:40px;opacity:.5;">
                                <h4 id="file-name" style="font-size:12.5px;color:#7a6255;margin-top:6px;">Ganti foto</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12"><div class="form-group"><label>Deskripsi</label><textarea name="description" rows="4" class="form-control">{{ $data->description }}</textarea></div></div>
                <div class="col-12 d-flex gap-2 mt-1">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
                    <button type="reset" class="btn btn-cancel"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div></div>

@endsection
