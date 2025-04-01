@extends('template.layout-admin')
@section('title_web', 'Ubah Data Produk | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Ubah Data Produk</h4>
            <h6>Mengubah data produk</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('productsListPut', $data->code_product) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $data->name }}" name="name" id="name"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Kode Produk <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $data->code_product }}" readonly name="code_product"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Harga Produk <span class="text-danger">*</span></label>
                            <input type="number" value="{{ $data->price }}" name="price" id="price"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Diskon Produk</label>
                            <input type="number" value="{{ $data->discount }}" name="discount" id="discount"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Stok Produk <span class="text-danger">*</span></label>
                            <input type="number" value="{{ $data->stock }}" name="stock" id="stock"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Kategori Produk <span class="text-danger">*</span></label>
                            <select class="js-example-basic-single select2" name="category_id" id="js-example-basic-single">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $data->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Ukuruan Produk <span class="text-danger">*</span></label>
                            <select class="form-control tagging" multiple="multiple">
                                <option>XS</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                                <option>XXL</option>
                                <option>XXXL</option>
                                <option>Custom</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status Produk <span class="text-danger">*</span></label>
                            <select class="select" name="is_active" id="is_active">
                                <option value="">-- Pilih Status --</option>
                                <option {{ $data->is_active == '1' ? 'selected' : '' }} value="1">Aktif</option>
                                <option {{ $data->is_active == '0' ? 'selected' : '' }} value="0">Tidak Aktif</option>
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
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $data->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Ubah</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>
@endsection
