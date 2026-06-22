@extends('template.layout-admin')
@section('title_web', 'Kategori Produk | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Kategori Produk</h4>
            <h6>Kelola kategori produk</h6>
        </div>
        <div class="page-btn">
            <a href="{{ url('/categories/add-categories') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $category)
                            <tr>
                                <td class="fw-500">{{ $category->name }}</td>
                                <td><span class="badge" style="background:#f3ede9;color:#b17457;border:1px solid #e8ddd7;">{{ $category->category_code }}</span></td>
                                <td class="text-muted">{{ Str::limit($category->description, 50) }}</td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ url('/categories/edit-categories/' . strtolower($category->category_code)) }}"
                                            class="btn btn-sm" style="background:#f3ede9;border:1px solid #e8ddd7;" title="Edit">
                                            <i class="bi bi-pencil" style="color:#b17457;"></i>
                                        </a>
                                        <form action="{{ route('categoryDelete', strtolower($category->category_code)) }}" method="post">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm confirm-text" style="background:#fdf2f2;border:1px solid #f5c6cb;" title="Hapus" type="submit">
                                                <i class="bi bi-trash" style="color:#dc3545;"></i>
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
