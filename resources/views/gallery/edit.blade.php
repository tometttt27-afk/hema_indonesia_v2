@extends('template.layout-admin')
@section('title_web', 'Ubah Data Galeri | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Ubah Data Galeri</h4>
            <h6>Mengubah data galeri</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('galleryCompanyPut', $data->code_gallery) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Judul Galeri <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $data->title }}" name="title" id="title"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Kode Galeri <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $data->code_gallery }}" readonly name="code_gallery"
                                id="" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Gambar Galeri <span class="text-danger">*</span></label>
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
