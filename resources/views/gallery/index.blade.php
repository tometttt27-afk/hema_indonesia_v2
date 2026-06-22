@extends('template.layout-admin')
@section('title_web', 'Data Galeri | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Data Galeri</h4>
            <h6>Kelola foto galeri perusahaan</h6>
        </div>
        <div class="page-btn">
            <a href="{{ url('/gallery-company/add-gallery-company') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Galeri
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $gallery)
                            <tr>
                                <td>
                                    <a href="{{ asset('uploads/gallery/' . $gallery->image) }}" class="image-popup">
                                        <img width="80" height="60" class="rounded"
                                            style="object-fit:cover;border:1px solid #e8ddd7;"
                                            src="{{ asset('uploads/gallery/' . $gallery->image) }}"
                                            alt="{{ $gallery->title }}">
                                    </a>
                                </td>
                                <td class="fw-500">{{ Str::limit($gallery->title, 40) }}</td>
                                <td><span class="badge" style="background:#f3ede9;color:#b17457;border:1px solid #e8ddd7;">{{ $gallery->code_gallery }}</span></td>
                                <td>
                                    <form action="{{ route('galleryCompanyStatusPut', $gallery->code_gallery) }}" method="post" style="display:inline;">
                                        @csrf @method('PUT')
                                        <button type="button" class="confirm-status" style="background:transparent;border:none;padding:0;">
                                            <div class="is_active-toggle d-flex align-items-center">
                                                <input type="checkbox" id="toggle_gal_{{ $gallery->code_gallery }}" class="check" name="is_active" value="1" {{ $gallery->is_active == 1 ? 'checked' : '' }}>
                                                <label for="toggle_gal_{{ $gallery->code_gallery }}" class="checktoggle">checkbox</label>
                                            </div>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ url('/gallery-company/edit-gallery-company/' . strtolower($gallery->code_gallery)) }}"
                                            class="btn btn-sm" style="background:#f3ede9;border:1px solid #e8ddd7;" title="Edit">
                                            <i class="bi bi-pencil" style="color:#b17457;"></i>
                                        </a>
                                        <form action="{{ route('galleryCompanyDelete', strtolower($gallery->code_gallery)) }}" method="post">
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
