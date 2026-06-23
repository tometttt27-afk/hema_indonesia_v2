@extends('template.layout-admin')
@section('title_web', 'Tambah FAQ | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <nav class="breadcrumb-admin">
            <a href="{{ url('/faq-company') }}">FAQ</a>
            <span class="sep">/</span>
            <span class="current">Tambah</span>
        </nav>
        <h4>Tambah FAQ</h4>
        <h6>Menambahkan pertanyaan umum baru</h6>
    </div>
    <a href="{{ url('/faq-company') }}" class="btn btn-secondary btn-cancel-nav" data-form="form-add-faq">
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
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
        </svg>
        <h5 class="card-title mb-0">Form Tambah FAQ</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('faqCompanyPost') }}" method="post" id="form-add-faq">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Judul FAQ <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('title') }}" name="title"
                               autocomplete="off" placeholder="Contoh: Bagaimana cara melakukan pemesanan?">
                        @error('title')<span class="field-error">{{ $message }}</span>@enderror
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
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Kode FAQ</label>
                        <input type="text" readonly name="code_faq" id="code_faq"
                               placeholder="Auto-generate" style="background:var(--bg);cursor:not-allowed;">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Deskripsi / Jawaban <span class="text-danger">*</span></label>
                        <textarea name="description" rows="6" class="form-control"
                                  placeholder="Tulis jawaban lengkap untuk pertanyaan ini...">{{ old('description') }}</textarea>
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
