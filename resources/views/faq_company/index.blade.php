@extends('template.layout-admin')
@section('title_web', 'FAQ Perusahaan | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title"><h4>Data FAQ Perusahaan</h4><h6>Kelola pertanyaan umum halaman website</h6></div>
    <a href="{{ url('/faq-company/add-faq-company') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah FAQ</a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2"><i class="bi bi-question-circle-fill" style="color:#b17457;"></i> Daftar FAQ</h5>
        <span class="badge badge-brand">{{ $data->count() }} FAQ</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
                <thead><tr><th>Judul FAQ</th><th>Deskripsi</th><th>Kode</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($data as $faq)
                    <tr>
                        <td class="fw-600">{{ Str::limit($faq->title,40) }}</td>
                        <td class="text-muted-brand">{{ Str::limit($faq->description,60) }}</td>
                        <td><span class="badge badge-brand">{{ $faq->code_faq }}</span></td>
                        <td>
                            <form action="{{ route('faqCompanyStatusPut',$faq->code_faq) }}" method="post" style="display:inline;">
                                @csrf @method('PUT')
                                <button type="button" class="confirm-status" style="background:transparent;border:none;padding:0;">
                                    <div class="is_active-toggle d-flex align-items-center">
                                        <input type="checkbox" id="tog_faq_{{ $faq->code_faq }}" class="check" name="is_active" value="1" {{ $faq->is_active==1?'checked':'' }}>
                                        <label for="tog_faq_{{ $faq->code_faq }}" class="checktoggle">checkbox</label>
                                    </div>
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/faq-company/edit-faq-company/'.strtolower($faq->code_faq)) }}" class="btn btn-sm btn-secondary"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('faqCompanyDelete',strtolower($faq->code_faq)) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm confirm-text" type="submit"
                                        style="background:#fef2f2;border:1px solid #fecaca;color:#ef4444;border-radius:5px;padding:5px 10px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
