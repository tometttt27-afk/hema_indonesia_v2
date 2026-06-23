@extends('template.layout-admin')
@section('title_web', 'Profil Perusahaan | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Profil Perusahaan</h4>
        <h6>Kelola informasi &amp; profil perusahaan (halaman Tentang)</h6>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger d-flex align-items-start gap-3 mb-4">
    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" class="flex-shrink-0 mt-1" style="color:var(--red);"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
    <div><strong>Terdapat {{ $errors->count() }} kesalahan:</strong>
        <ul class="mb-0 mt-1 ps-3">@foreach($errors->all() as $e)<li style="font-size:13px;">{{ $e }}</li>@endforeach</ul>
    </div>
</div>
@endif

<form action="{{ route('aboutCompanyPut') }}" method="post" enctype="multipart/form-data" id="form-about">
    @csrf @method('PUT')
    <div class="row g-3">

        {{-- Kolom kiri --}}
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header">
                    {{-- icon building siluet --}}
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                        <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                    </svg>
                    <h5 class="card-title mb-0">Informasi Perusahaan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Perusahaan</label>
                                <input type="text" value="{{ old('name', $data->name ?? '') }}" name="name"
                                       autocomplete="off" placeholder="Contoh: Hema Indonesia">
                                @error('name')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tagline / Breadcrumb</label>
                                <input type="text" value="{{ old('breadcrumb', $data->breadcrumb ?? '') }}" name="breadcrumb"
                                       autocomplete="off" placeholder="Contoh: Fashion Muslim Terpercaya">
                                @error('breadcrumb')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Deskripsi Perusahaan</label>
                                <textarea name="about_description_company" rows="6" class="form-control"
                                          placeholder="Ceritakan tentang perusahaan, visi, misi, dan keunggulan...">{{ old('about_description_company', $data->about_description_company ?? '') }}</textarea>
                                @error('about_description_company')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    {{-- icon share siluet --}}
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                        <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/>
                    </svg>
                    <h5 class="card-title mb-0">Media Sosial</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="url" value="{{ old('instagram', $data->instagram ?? '') }}" name="instagram"
                                       placeholder="https://instagram.com/hema_indonesia" autocomplete="off">
                                @error('instagram')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>TikTok</label>
                                <input type="url" value="{{ old('tiktok', $data->tiktok ?? '') }}" name="tiktok"
                                       placeholder="https://tiktok.com/@hema_indonesia" autocomplete="off">
                                @error('tiktok')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="url" value="{{ old('facebook', $data->facebook ?? '') }}" name="facebook"
                                       placeholder="https://facebook.com/hema_indonesia" autocomplete="off">
                                @error('facebook')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label>YouTube</label>
                                <input type="url" value="{{ old('youtube', $data->youtube ?? '') }}" name="youtube"
                                       placeholder="https://youtube.com/@hema_indonesia" autocomplete="off">
                                @error('youtube')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom kanan --}}
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header">
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                    </svg>
                    <h5 class="card-title mb-0">Logo</h5>
                </div>
                <div class="card-body">
                    @if(!empty($data) && $data->logo)
                        <img src="{{ asset('uploads/about/'.$data->logo) }}" alt="logo"
                             class="rounded mb-3 d-block"
                             style="max-height:80px;object-fit:contain;border:1px solid var(--bd);padding:8px;">
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    @error('logo')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                    </svg>
                    <h5 class="card-title mb-0">Foto Tentang</h5>
                </div>
                <div class="card-body">
                    @if(!empty($data) && $data->about_img_company)
                        <img src="{{ asset('uploads/about/'.$data->about_img_company) }}" alt="about"
                             class="rounded mb-3 w-100"
                             style="max-height:120px;object-fit:cover;border:1px solid var(--bd);">
                    @endif
                    <input type="file" name="about_img_company" class="form-control" accept="image/*">
                    @error('about_img_company')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
