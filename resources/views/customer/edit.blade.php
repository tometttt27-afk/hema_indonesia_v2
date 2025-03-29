@extends('template.layout-admin')
@section('title_web', 'Ubah Kategori Produk | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Ubah Kategori Produk</h4>
            <h6>Mengubah data kategori produk</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categoryPut', $data->category_code) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" name="name" value="{{ $data->name }}" id="name"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Kode Kategori</label>
                            <input type="text" value="{{ $data->category_code }}" readonly name="category_code"
                                id="" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
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
