@extends('template.layout-admin')
@section('title_web', 'Tambah Produk | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Tambah Data Produk</h4>
        <h6>Menambahkan produk baru ke katalog</h6>
    </div>
    <a href="{{ url('/product-list') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<form action="{{ route('productsListPost') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        {{-- Main info --}}
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="bi bi-info-circle me-2" style="color:#b17457;"></i>Informasi Produk</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name') }}" name="name" id="name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kode Produk</label>
                                <input type="text" value="" readonly name="code_product" id="code_product"
                                    style="background:#f5f5f5;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Harga <span class="text-danger">*</span></label>
                                <input type="number" value="{{ old('price') }}" name="price" id="price" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Diskon (%)</label>
                                <input type="number" value="{{ old('discount') }}" name="discount" autocomplete="off" placeholder="0">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Stok <span class="text-danger">*</span></label>
                                <input type="number" value="{{ old('stock') }}" name="stock" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select class="js-example-basic-single select2" name="category_id" id="js-example-basic-single">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Ukuran <span class="text-danger">*</span></label>
                                <select name="size[]" class="form-control basic tagging" multiple="multiple">
                                    @foreach(['xs','s','m','l','xl','xxl','xxxl','custom'] as $sz)
                                        <option value="{{ $sz }}">{{ strtoupper($sz) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="select" name="is_active">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Deskripsi <span class="text-danger">*</span></label>
                                <textarea name="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Image upload --}}
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="bi bi-image me-2" style="color:#b17457;"></i>Foto Produk</h5>
                </div>
                <div class="card-body">
                    <div class="form-group mb-0">
                        <label>Gambar Produk <span class="text-danger">*</span></label>
                        <div class="image-upload">
                            <input name="image" id="file_drop" type="file" onchange="updateFileName()">
                            <div class="image-uploads" id="upload-area">
                                <img src="{{ asset('admin/img/icons/upload.svg') }}" alt="Upload" style="width:48px;opacity:.5;">
                                <h4 id="file-name" style="font-size:13px;color:#7a6255;margin-top:8px;">Drag & drop atau klik</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-check-lg me-1"></i> Simpan Produk
                    </button>
                    <button type="reset" class="btn btn-cancel w-100">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
