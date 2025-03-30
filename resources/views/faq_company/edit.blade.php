@extends('template.layout-admin')
@section('title_web', 'Ubah Data FAQ Perusahan | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Ubah Data FAQ Perusahan</h4>
            <h6>Mengubah data FAQ perusahan</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('faqCompanyPut', $data->code_faq) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Judul FAQ</label>
                            <input type="text" value="{{ $data->title }}" name="title" id="title"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Kode FAQ Perusahaan</label>
                            <input type="text" value="{{ $data->code_faq }}" readonly name="code_faq" autocomplete="off">
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
