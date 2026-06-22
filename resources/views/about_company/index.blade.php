@extends('template.layout-admin')
@section('title_web', 'Profil Perusahaan | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title"><h4>Profil Perusahaan</h4><h6>Kelola informasi & profil perusahaan (halaman Tentang)</h6></div>
</div>

<form action="{{ route('aboutCompanyPut') }}" method="post" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0"><i class="bi bi-building me-2" style="color:#b17457;"></i>Informasi Perusahaan</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label>Nama Perusahaan</label><input type="text" value="{{ old('name',$data->name??'') }}" name="name" autocomplete="off"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label>Tagline / Breadcrumb</label><input type="text" value="{{ old('breadcrumb',$data->breadcrumb??'') }}" name="breadcrumb" autocomplete="off"></div></div>
                        <div class="col-12"><div class="form-group mb-0"><label>Deskripsi Perusahaan</label><textarea name="about_description_company" rows="6" class="form-control">{{ old('about_description_company',$data->about_description_company??'') }}</textarea></div></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0"><i class="bi bi-share me-2" style="color:#b17457;"></i>Media Sosial</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6"><div class="form-group"><label><i class="fab fa-instagram me-1"></i> Instagram</label><input type="text" value="{{ old('instagram',$data->instagram??'') }}" name="instagram" placeholder="https://instagram.com/..." autocomplete="off"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label><i class="fab fa-tiktok me-1"></i> TikTok</label><input type="text" value="{{ old('tiktok',$data->tiktok??'') }}" name="tiktok" placeholder="https://tiktok.com/..." autocomplete="off"></div></div>
                        <div class="col-lg-6"><div class="form-group"><label><i class="fab fa-facebook me-1"></i> Facebook</label><input type="text" value="{{ old('facebook',$data->facebook??'') }}" name="facebook" placeholder="https://facebook.com/..." autocomplete="off"></div></div>
                        <div class="col-lg-6"><div class="form-group mb-0"><label><i class="fab fa-youtube me-1"></i> YouTube</label><input type="text" value="{{ old('youtube',$data->youtube??'') }}" name="youtube" placeholder="https://youtube.com/..." autocomplete="off"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0"><i class="bi bi-image me-2" style="color:#b17457;"></i>Logo</h5></div>
                <div class="card-body">
                    @if(!empty($data) && $data->logo)
                        <img src="{{ asset('uploads/about/'.$data->logo) }}" alt="logo" class="rounded mb-3 d-block" style="max-height:80px;object-fit:contain;border:1px solid #ede3db;padding:8px;">
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header"><h5 class="card-title mb-0"><i class="bi bi-card-image me-2" style="color:#b17457;"></i>Foto Tentang</h5></div>
                <div class="card-body">
                    @if(!empty($data) && $data->about_img_company)
                        <img src="{{ asset('uploads/about/'.$data->about_img_company) }}" alt="about" class="rounded mb-3 w-100" style="max-height:120px;object-fit:cover;border:1px solid #ede3db;">
                    @endif
                    <input type="file" name="about_img_company" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-check-lg me-1"></i>Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
