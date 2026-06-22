@extends('template.layout-admin')
@section('title_web', 'FAQ Perusahaan | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Data FAQ Perusahaan</h4>
            <h6>Kelola pertanyaan umum yang tampil di website</h6>
        </div>
        <div class="page-btn">
            <a href="{{ url('/faq-company/add-faq-company') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah FAQ
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>Judul FAQ</th>
                            <th>Deskripsi</th>
                            <th>Kode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $faq)
                            <tr>
                                <td class="fw-500">{{ Str::limit($faq->title, 40) }}</td>
                                <td class="text-muted">{{ Str::limit($faq->description, 60) }}</td>
                                <td><span class="badge" style="background:#f3ede9;color:#b17457;border:1px solid #e8ddd7;">{{ $faq->code_faq }}</span></td>
                                <td>
                                    <form action="{{ route('faqCompanyStatusPut', $faq->code_faq) }}" method="post" style="display:inline;">
                                        @csrf @method('PUT')
                                        <button type="button" class="confirm-status" style="background:transparent;border:none;padding:0;">
                                            <div class="is_active-toggle d-flex align-items-center">
                                                <input type="checkbox" id="toggle_faq_{{ $faq->code_faq }}" class="check" name="is_active" value="1" {{ $faq->is_active == 1 ? 'checked' : '' }}>
                                                <label for="toggle_faq_{{ $faq->code_faq }}" class="checktoggle">checkbox</label>
                                            </div>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ url('/faq-company/edit-faq-company/' . strtolower($faq->code_faq)) }}"
                                            class="btn btn-sm" style="background:#f3ede9;border:1px solid #e8ddd7;" title="Edit">
                                            <i class="bi bi-pencil" style="color:#b17457;"></i>
                                        </a>
                                        <form action="{{ route('faqCompanyDelete', strtolower($faq->code_faq)) }}" method="post">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm confirm-text" style="background:#fdf2f2;border:1px solid #f5c6cb;" title="Hapus" type="submit">
                                                <i class="bi bi-trash" style="color:#dc3545;"></i>
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
