@extends('template.layout-admin')
@section('title_web', 'Ubah Kategori | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <nav class="breadcrumb-admin">
            <a href="{{ url('/categories') }}">Kategori</a>
            <span class="sep">/</span>
            <span class="current">Ubah: {{ $data->name }}</span>
        </nav>
        <h4>Ubah Kategori Produk</h4>
        <h6>Mengubah data kategori</h6>
    </div>
    <a href="{{ url('/categories') }}" class="btn btn-secondary btn-cancel-nav" data-form="form-edit-cat">
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
<div class="col-lg-8">
<div class="card">
    <div class="card-header">
        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
        </svg>
        <h5 class="card-title mb-0">Form Ubah Kategori</h5>
        <span class="badge badge-brand">{{ $data->category_code }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('categoryPut', $data->category_code) }}" method="post" id="form-edit-cat">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name',$data->name) }}" id="name"
                               autocomplete="off" placeholder="Nama kategori">
                        @error('name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Kode Kategori</label>
                        <input type="text" value="{{ $data->category_code }}" readonly name="category_code"
                               placeholder="Kode tidak bisa diubah">
                        <small style="font-size:11px;color:var(--tx-4);margin-top:3px;display:block;">Kode tidak dapat diubah</small>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" rows="4" class="form-control"
                                  placeholder="Deskripsi singkat kategori...">{{ old('description',$data->description) }}</textarea>
                        @error('description')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-12 d-flex gap-2 mt-2">
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
