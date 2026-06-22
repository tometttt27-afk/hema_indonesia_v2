@extends('template.layout-admin')
@section('title_web', 'Data Perusahaan | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Data Perusahaan</h4>
            <h6>Mengelola informasi & profil perusahaan (halaman Tentang)</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('aboutCompanyPut') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Perusahaan</label>
                            <input type="text" value="{{ old('name', $data->name ?? '') }}" name="name" id="name"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Breadcrumb / Tagline</label>
                            <input type="text" value="{{ old('breadcrumb', $data->breadcrumb ?? '') }}" name="breadcrumb"
                                id="breadcrumb" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Deskripsi Perusahaan</label>
                            <textarea name="about_description_company" id="about_description_company" cols="30" rows="6"
                                class="form-control">{{ old('about_description_company', $data->about_description_company ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Instagram (URL)</label>
                            <input type="text" value="{{ old('instagram', $data->instagram ?? '') }}" name="instagram"
                                id="instagram" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Tiktok (URL)</label>
                            <input type="text" value="{{ old('tiktok', $data->tiktok ?? '') }}" name="tiktok"
                                id="tiktok" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Facebook (URL)</label>
                            <input type="text" value="{{ old('facebook', $data->facebook ?? '') }}" name="facebook"
                                id="facebook" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Youtube (URL)</label>
                            <input type="text" value="{{ old('youtube', $data->youtube ?? '') }}" name="youtube"
                                id="youtube" autocomplete="off">
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Logo Perusahaan</label>
                            <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                            @if (!empty($data) && $data->logo)
                                <img class="mt-2" src="{{ asset('uploads/about/' . $data->logo) }}" alt="logo"
                                    width="120">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Gambar Tentang Perusahaan</label>
                            <input type="file" name="about_img_company" id="about_img_company" class="form-control"
                                accept="image/*">
                            @if (!empty($data) && $data->about_img_company)
                                <img class="mt-2" src="{{ asset('uploads/about/' . $data->about_img_company) }}"
                                    alt="about" width="120">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
