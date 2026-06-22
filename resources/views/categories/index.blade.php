@extends('template.layout-admin')
@section('title_web', 'Kategori Produk | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Kategori Produk</h4>
        <h6>Kelola semua kategori produk</h6>
    </div>
    <div class="page-btn">
        <a href="{{ url('/categories/add-categories') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Kategori
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2">
            <i class="bi bi-tags-fill" style="color:#b17457;"></i> Daftar Kategori
        </h5>
        <span class="badge badge-brand">{{ $data->count() }} kategori</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
                <thead><tr>
                    <th>#</th><th>Nama Kategori</th><th>Kode</th><th>Deskripsi</th><th>Aksi</th>
                </tr></thead>
                <tbody>
                    @foreach($data as $i => $category)
                    <tr>
                        <td class="text-muted-brand" style="width:40px;">{{ $i+1 }}</td>
                        <td class="fw-600">{{ $category->name }}</td>
                        <td>
                            <span class="badge badge-brand">{{ $category->category_code }}</span>
                        </td>
                        <td class="text-muted-brand" style="max-width:280px;">
                            {{ Str::limit($category->description, 60) }}
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/categories/edit-categories/'.strtolower($category->category_code)) }}"
                                   class="btn btn-sm btn-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('categoryDelete', strtolower($category->category_code)) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm confirm-text" title="Hapus" type="submit"
                                        style="background:#fef2f2;border:1px solid #fecaca;color:#ef4444;border-radius:5px;padding:5px 10px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
