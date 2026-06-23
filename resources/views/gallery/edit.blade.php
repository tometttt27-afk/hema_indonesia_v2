@extends('template.layout-admin')
@section('title_web', 'Ubah Galeri | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <nav class="breadcrumb-admin">
            <a href="{{ url('/gallery-company') }}">Galeri</a>
            <span class="sep">/</span>
            <span class="current">Ubah: {{ Str::limit($data->title,30) }}</span>
        </nav>
        <h4>Ubah Galeri</h4>
        <h6>Mengubah data foto galeri</h6>
    </div>
    <a href="{{ url('/gallery-company') }}" class="btn btn-secondary btn-cancel-nav" data-form="form-edit-gallery">
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

<div class="row justify-content-center"><div class="col-lg-8">
<div class="card">
    <div class="card-header">
        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
        </svg>
        <h5 class="card-title mb-0">Form Ubah Galeri</h5>
        <span class="badge badge-brand">{{ $data->code_gallery }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('galleryCompanyPut',$data->code_gallery) }}" method="post"
              enctype="multipart/form-data" id="form-edit-gallery">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Judul Galeri <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('title',$data->title) }}" name="title"
                               autocomplete="off" placeholder="Judul foto galeri">
                        @error('title')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Kode Galeri</label>
                        <input type="text" value="{{ $data->code_gallery }}" readonly name="code_gallery"
                               style="background:var(--bg);cursor:not-allowed;">
                        <small style="font-size:11px;color:var(--tx-4);margin-top:3px;display:block;">Kode tidak dapat diubah</small>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Gambar Baru <small class="text-muted-brand">(opsional — kosongkan jika tidak ingin mengganti)</small></label>
                        @if($data->image)
                            <img src="{{ asset('uploads/gallery/'.$data->image) }}" alt="{{ $data->title }}"
                                 class="rounded d-block mb-2" style="max-height:120px;object-fit:cover;border:1px solid var(--bd);">
                        @endif
                        <div class="image-upload">
                            <input name="image" id="file_drop" type="file" onchange="updateFileName()">
                            <div class="image-uploads" id="upload-area">
                                <svg width="32" height="32" fill="currentColor" viewBox="0 0 24 24"
                                     style="color:var(--br-lt);opacity:.6;margin:0 auto 6px;">
                                    <path d="M19.35 10.04A7.49 7.49 0 0012 4C9.11 4 6.6 5.64 5.35 8.04A5.994 5.994 0 000 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                                </svg>
                                <h4 id="file-name" style="font-size:12.5px;color:var(--tx-3);margin-top:0;">Klik untuk ganti foto</h4>
                            </div>
                        </div>
                        @error('image')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" rows="4" class="form-control"
                                  placeholder="Deskripsi foto galeri...">{{ old('description',$data->description) }}</textarea>
                        @error('description')<span class="field-error">{{ $message }}</span>@enderror
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
</div></div>
@endsection
