@extends('template.layout-admin')
@section('title_web', 'Data Galeri | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Data Galeri</h4>
        <h6>Kelola foto galeri perusahaan</h6>
    </div>
    <a href="{{ url('/gallery-company/add-gallery-company') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Galeri
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2">
            <i class="bi bi-images" style="color:#b17457;"></i> Daftar Galeri
        </h5>
        <span class="badge badge-brand">{{ $data->count() }} foto</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
                <thead><tr><th>Gambar</th><th>Judul</th><th>Kode</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($data as $gallery)
                    <tr>
                        <td style="width:90px;">
                            <a href="{{ asset('uploads/gallery/'.$gallery->image) }}" class="image-popup">
                                <img width="80" height="60" class="rounded"
                                    style="object-fit:cover;border:1.5px solid #ede3db;"
                                    src="{{ asset('uploads/gallery/'.$gallery->image) }}" alt="{{ $gallery->title }}">
                            </a>
                        </td>
                        <td class="fw-600">{{ Str::limit($gallery->title,45) }}</td>
                        <td><span class="badge badge-brand">{{ $gallery->code_gallery }}</span></td>
                        <td>
                            <form action="{{ route('galleryCompanyStatusPut',$gallery->code_gallery) }}" method="post" style="display:inline;">
                                @csrf @method('PUT')
                                <button type="button" class="confirm-status" style="background:transparent;border:none;padding:0;">
                                    <div class="is_active-toggle d-flex align-items-center">
                                        <input type="checkbox" id="tog_gal_{{ $gallery->code_gallery }}" class="check" name="is_active" value="1" {{ $gallery->is_active==1?'checked':'' }}>
                                        <label for="tog_gal_{{ $gallery->code_gallery }}" class="checktoggle">checkbox</label>
                                    </div>
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/gallery-company/edit-gallery-company/'.strtolower($gallery->code_gallery)) }}"
                                    class="btn btn-sm btn-secondary"><i class="bi bi-pencil"></i></a>
                                <button type="button"
                                        class="btn btn-sm btn-soft-danger btn-delete"
                                        data-form="form-del-gal-{{ $gallery->code_gallery }}"
                                        data-name="{{ $gallery->title }}"
                                        data-type="Galeri"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <form id="form-del-gal-{{ $gallery->code_gallery }}"
                                      action="{{ route('galleryCompanyDelete', strtolower($gallery->code_gallery)) }}"
                                      method="post" class="d-none">
                                    @csrf @method('DELETE')
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
