@extends('template.layout-admin')
@section('title_web', 'Tambah Data Produk | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Tambah Data Produk</h4>
            <h6>Menambahkan data baru produk</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('productsListPost') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Kode Produk <span class="text-danger">*</span></label>
                            <input type="text" value="" readonly name="code_product" id="code_product"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Harga Produk <span class="text-danger">*</span></label>
                            <input type="number" value="{{ old('price') }}" name="price" id="price"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Diskon Produk (opsional)</label>
                            <input type="number" value="{{ old('discount') }}" name="discount" id="discount"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Stok Produk <span class="text-danger">*</span></label>
                            <input type="number" value="{{ old('stock') }}" name="stock" id="stock"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Kategori Produk <span class="text-danger">*</span></label>
                            <select class="js-example-basic-single basic select2" name="category_id"
                                id="js-example-basic-single">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Ukuruan Produk <span class="text-danger">*</span></label>
                            <select name="size[]" class="form-control basic tagging" multiple="multiple">
                                <option value="xs">XS</option>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                                <option value="xl">XL</option>
                                <option value="xxl">XXL</option>
                                <option value="xxxl">XXXL</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status Produk <span class="text-danger">*</span></label>
                            <select class="select" name="is_active" id="is_active">
                                <option value="">-- Pilih Status --</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Gambar Produk <span class="text-danger">*</span></label>
                            <div class="image-upload">
                                <input name="image" id="file_drop" type="file" onchange="updateFileName()">
                                <div class="image-uploads" id="upload-area">
                                    <img src="{{ asset('admin/img/icons/upload.svg') }}" alt="Upload Icon">
                                    <h4 id="file-name">Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Kirim</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
