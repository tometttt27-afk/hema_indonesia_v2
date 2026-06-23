@extends('template.layout-admin')
@section('title_web', 'Kategori Produk | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Kategori Produk</h4>
        <h6>Kelola semua kategori produk</h6>
    </div>
    <a href="{{ url('/categories/add-categories') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
        Tambah Kategori
    </a>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                <path d="M20 6H4l8-4 8 4zm-9 4v9H4v-9h7zm2 0h7v9h-7v-9z"/>
            </svg>
            <h5 class="card-title mb-0">Daftar Kategori</h5>
        </div>
        <span class="badge badge-brand">{{ $data->count() }} kategori</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
                <thead>
                    <tr><th>#</th><th>Nama Kategori</th><th>Kode</th><th>Deskripsi</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $category)
                    <tr>
                        <td class="text-muted-brand" style="width:40px;">{{ $i+1 }}</td>
                        <td class="fw-600">{{ $category->name }}</td>
                        <td><span class="badge badge-brand">{{ $category->category_code }}</span></td>
                        <td class="text-muted-brand" style="max-width:280px;">{{ Str::limit($category->description,60) }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/categories/edit-categories/'.strtolower($category->category_code)) }}"
                                   class="btn btn-sm btn-secondary"
                                   aria-label="Edit kategori {{ $category->name }}"
                                   title="Edit kategori">
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-soft-danger btn-delete"
                                        data-form="form-del-cat-{{ $category->category_code }}"
                                        data-name="{{ $category->name }}"
                                        data-type="Kategori"
                                        aria-label="Hapus kategori {{ $category->name }}"
                                        title="Hapus kategori">
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                    </svg>
                                </button>
                                <form id="form-del-cat-{{ $category->category_code }}"
                                      action="{{ route('categoryDelete', strtolower($category->category_code)) }}"
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
                                <path d="M20 6H4l8-4 8 4zm-9 4v9H4v-9h7zm2 0h7v9h-7v-9z"/>
                            </svg>
                            <p style="color:var(--tx-3);">Belum ada kategori.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
