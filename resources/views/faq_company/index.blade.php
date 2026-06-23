@extends('template.layout-admin')
@section('title_web', 'FAQ Perusahaan | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Data FAQ Perusahaan</h4>
        <h6>Kelola pertanyaan umum halaman website</h6>
    </div>
    <a href="{{ url('/faq-company/add-faq-company') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
        Tambah FAQ
    </a>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
            </svg>
            <h5 class="card-title mb-0">Daftar FAQ</h5>
        </div>
        <span class="badge badge-brand">{{ $data->count() }} FAQ</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
                <thead>
                    <tr><th>Judul FAQ</th><th>Deskripsi</th><th>Kode</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($data as $faq)
                    <tr>
                        <td class="fw-600">{{ Str::limit($faq->title,40) }}</td>
                        <td class="text-muted-brand">{{ Str::limit($faq->description,60) }}</td>
                        <td><span class="badge badge-brand">{{ $faq->code_faq }}</span></td>

                        {{-- FIX: toggle + label teks konsisten --}}
                        <td>
                            <form action="{{ route('faqCompanyStatusPut',$faq->code_faq) }}"
                                  method="post" style="display:inline;">
                                @csrf @method('PUT')
                                <button type="button" class="confirm-status"
                                        style="background:transparent;border:none;padding:0;"
                                        aria-label="{{ $faq->is_active ? 'Nonaktifkan' : 'Aktifkan' }} FAQ {{ $faq->title }}"
                                        title="{{ $faq->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <div class="is_active-toggle d-flex align-items-center">
                                        <input type="checkbox" id="tog_faq_{{ $faq->code_faq }}"
                                               class="check" name="is_active" value="1"
                                               {{ $faq->is_active==1?'checked':'' }}>
                                        <label for="tog_faq_{{ $faq->code_faq }}" class="checktoggle">checkbox</label>
                                    </div>
                                </button>
                            </form>
                            <span class="toggle-label-text {{ $faq->is_active ? 'is-active' : 'is-inactive' }}">
                                {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/faq-company/edit-faq-company/'.strtolower($faq->code_faq)) }}"
                                   class="btn btn-sm btn-secondary"
                                   aria-label="Edit FAQ {{ $faq->title }}" title="Edit">
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-soft-danger btn-delete"
                                        data-form="form-del-faq-{{ $faq->code_faq }}"
                                        data-name="{{ Str::limit($faq->title,40) }}"
                                        data-type="FAQ"
                                        aria-label="Hapus FAQ {{ $faq->title }}" title="Hapus">
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                    </svg>
                                </button>
                                <form id="form-del-faq-{{ $faq->code_faq }}"
                                      action="{{ route('faqCompanyDelete', strtolower($faq->code_faq)) }}"
                                      method="post" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <svg width="40" height="40" fill="currentColor" viewBox="0 0 24 24"
                                 style="color:var(--br-lt);opacity:.4;display:block;margin:0 auto 10px;">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                            </svg>
                            <p style="color:var(--tx-3);">Belum ada FAQ.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
