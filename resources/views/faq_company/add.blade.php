@extends('template.layout-admin')
@section('title_web', 'Tambah FAQ | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title"><h4>Tambah FAQ</h4><h6>Menambahkan pertanyaan umum baru</h6></div>
    <a href="{{ url('/faq-company') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row justify-content-center"><div class="col-lg-8">
<div class="card">
    <div class="card-header"><h5 class="card-title mb-0"><i class="bi bi-plus-circle me-2" style="color:#b17457;"></i>Form Tambah FAQ</h5></div>
    <div class="card-body">
        <form action="{{ route('faqCompanyPost') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12"><div class="form-group"><label>Judul FAQ <span class="text-danger">*</span></label><input type="text" value="{{ old('title') }}" name="title" autocomplete="off"></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Status <span class="text-danger">*</span></label><select class="select" name="is_active"><option value="">-- Pilih Status --</option><option value="1">Aktif</option><option value="0">Tidak Aktif</option></select></div></div>
                <div class="col-lg-6"><div class="form-group"><label>Kode FAQ</label><input type="text" readonly name="code_faq" id="code_faq" style="background:#f5f5f5;cursor:not-allowed;"></div></div>
                <div class="col-12"><div class="form-group"><label>Deskripsi / Jawaban <span class="text-danger">*</span></label><textarea name="description" rows="6" class="form-control">{{ old('description') }}</textarea></div></div>
                <div class="col-12 d-flex gap-2 mt-1">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                    <button type="reset" class="btn btn-cancel"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div></div>

@endsection
