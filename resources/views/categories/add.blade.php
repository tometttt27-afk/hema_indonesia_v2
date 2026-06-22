@extends('template.layout-admin')
@section('title_web', 'Tambah Kategori | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Tambah Kategori Produk</h4>
        <h6>Menambahkan kategori baru</h6>
    </div>
    <a href="{{ url('/categories') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="bi bi-plus-circle me-2" style="color:#b17457;"></i>Form Tambah Kategori</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('categoryPost') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name') }}" name="name" id="name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kode Kategori</label>
                                <input type="text" value="" readonly name="category_code" id="category_code" autocomplete="off"
                                    style="background:#f5f5f5;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" id="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex gap-2 mt-2">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                            <button type="reset" class="btn btn-cancel"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
