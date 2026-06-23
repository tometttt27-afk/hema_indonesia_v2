@extends('template.layout-admin')
@section('title_web', 'Tambah Galeri | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <nav class="breadcrumb-admin">
            <a href="{{ url('/gallery-company') }}">Galeri</a>
            <span class="sep">/</span>
            <span class="current">Tambah</span>
        </nav>
        <h4>Tambah Galeri</h4>
        <h6>Menambahkan foto galeri baru</h6>
    </div>
    <a href="{{ url('/gallery-company') }}" class="btn btn-secondary btn-cancel-nav" data-form="form-add-gallery">
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
            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
        </svg>
        <h5 class="card-title mb-0">Form Tambah Galeri</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('galleryCompanyPost') }}" method="post" enctype="multipart/form-data" id="form-add-gallery">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Judul Galeri <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('title') }}" name="title"
                               autocomplete="off" placeholder="Contoh: Koleksi Gamis Terbaru 2025">
                        @error('title')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Kode Galeri</label>
                        <input type="text" readonly name="code_gallery" id="code_gallery"
                               placeholder="Auto-generate" style="background:var(--bg);cursor:not-allowed;">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="select" name="is_active">
                            <option value="">-- Pilih Status --</option>
                            <option value="1" {{ old('is_active')==='1'?'selected':'' }}>Aktif</option>
                            <option value="0" {{ old('is_active')==='0'?'selected':'' }}>Tidak Aktif</option>
                        </select>
                        @error('is_active')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Gambar <span class="text-danger">*</span></label>
                        <div class="image-upload">
                            <input name="image" id="file_drop" type="file" onchange="updateFileName()">
                            <div class="image-uploads" id="upload-area">
                                <svg width="36" height="36" fill="currentColor" viewBox="0 0 24 24"
                                     style="color:var(--br-lt);opacity:.6;margin:0 auto 8px;">
                                    <path d="M19.35 10.04A7.49 7.49 0 0012 4C9.11 4 6.6 5.64 5.35 8.04A5.994 5.994 0 000 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                                </svg>
                                <h4 id="file-name" style="font-size:13px;color:var(--tx-3);margin-top:0;">Drag &amp; drop atau klik</h4>
                            </div>
                        </div>
                        @error('image')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" rows="4" class="form-control"
                                  placeholder="Deskripsi foto galeri...">{{ old('description') }}</textarea>
                        @error('description')<span class="field-error">{{ $message }}</span>@enderror
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
</div></div>
@endsection
