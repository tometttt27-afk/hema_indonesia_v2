@extends('template.layout-admin')
@section('title_web', 'Tambah Data FAQ Perusahan | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Tambah Data FAQ Perusahan</h4>
            <h6>Menambahkan data baru FAQ perusahaan</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('faqCompanyPost') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Judul FAQ</label>
                            <input type="text" value="{{ old('title') }}" name="title" id="title"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status FAQ</label>
                            <select class="select" name="is_active" id="is_active">
                                <option value="">-- Pilih Status --</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Kode FAQ Perusahaan</label>
                            <input type="text" value="" readonly name="code_faq" id="code_faq" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
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

    </div>
@endsection
