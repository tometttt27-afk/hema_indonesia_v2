@extends('template.layout-admin')
@section('title_web', 'Data Galeri | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Data Galeri</h4>
        <h6>Kelola foto galeri perusahaan</h6>
    </div>
    <a href="{{ url('/gallery-company/add-gallery-company') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
        Tambah Galeri
    </a>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
            </svg>
            <h5 class="card-title mb-0">Daftar Galeri</h5>
        </div>
        <span class="badge badge-brand">{{ $data->count() }} foto</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
                <thead>
                    <tr><th>Gambar</th><th>Judul</th><th>Kode</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($data as $gallery)
                    <tr>
                        <td style="width:90px;">
                            <a href="{{ asset('uploads/gallery/'.$gallery->image) }}" class="image-popup">
                                <img width="80" height="60" class="rounded"
                                     style="object-fit:cover;border:1px solid var(--bd);"
                                     src="{{ asset('uploads/gallery/'.$gallery->image) }}"
                                     alt="{{ $gallery->title }}">
                            </a>
                        </td>
                        <td class="fw-600">{{ Str::limit($gallery->title,45) }}</td>
                        <td><span class="badge badge-brand">{{ $gallery->code_gallery }}</span></td>

                        {{-- FIX: toggle + label teks konsisten --}}
                        <td>
                            <form action="{{ route('galleryCompanyStatusPut',$gallery->code_gallery) }}"
                                  method="post" style="display:inline;">
                                @csrf @method('PUT')
                                <button type="button" class="confirm-status"
                                        style="background:transparent;border:none;padding:0;"
                                        aria-label="{{ $gallery->is_active ? 'Nonaktifkan' : 'Aktifkan' }} galeri {{ $gallery->title }}"
                                        title="{{ $gallery->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <div class="is_active-toggle d-flex align-items-center">
                                        <input type="checkbox" id="tog_gal_{{ $gallery->code_gallery }}"
                                               class="check" name="is_active" value="1"
                                               {{ $gallery->is_active==1?'checked':'' }}>
                                        <label for="tog_gal_{{ $gallery->code_gallery }}" class="checktoggle">checkbox</label>
                                    </div>
                                </button>
                            </form>
                            <span class="toggle-label-text {{ $gallery->is_active ? 'is-active' : 'is-inactive' }}">
                                {{ $gallery->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/gallery-company/edit-gallery-company/'.strtolower($gallery->code_gallery)) }}"
                                   class="btn btn-sm btn-secondary"
                                   aria-label="Edit galeri {{ $gallery->title }}" title="Edit">
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-soft-danger btn-delete"
                                        data-form="form-del-gal-{{ $gallery->code_gallery }}"
                                        data-name="{{ $gallery->title }}"
                                        data-type="Galeri"
                                        aria-label="Hapus galeri {{ $gallery->title }}" title="Hapus">
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                    </svg>
                                </button>
                                <form id="form-del-gal-{{ $gallery->code_gallery }}"
                                      action="{{ route('galleryCompanyDelete', strtolower($gallery->code_gallery)) }}"
                                      method="post" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <svg width="44" height="44" fill="currentColor" viewBox="0 0 24 24"
                                 style="color:var(--br-lt);opacity:.4;display:block;margin:0 auto 10px;">
                                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                            </svg>
                            <p style="color:var(--tx-3);">Belum ada foto galeri.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
