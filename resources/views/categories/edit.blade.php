@extends('template.layout-admin')
@section('title_web', 'Ubah Kategori | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Ubah Kategori Produk</h4>
        <h6>Mengubah data kategori</h6>
    </div>
    <a href="{{ url('/categories') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="bi bi-pencil-square me-2" style="color:#b17457;"></i>Form Ubah Kategori</h5>
                <span class="badge badge-brand">{{ $data->category_code }}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('categoryPut', $data->category_code) }}" method="post">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ $data->name }}" id="name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kode Kategori</label>
                                <input type="text" value="{{ $data->category_code }}" readonly name="category_code"
                                    style="background:#f5f5f5;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" rows="5" class="form-control">{{ $data->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex gap-2 mt-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
                            <button type="reset" class="btn btn-cancel"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
