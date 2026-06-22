@extends('template.layout-admin')
@section('title_web', 'Data Pelanggan | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Data Pelanggan</h4>
        <h6>Kelola akun pelanggan terdaftar</h6>
    </div>
    <a href="{{ url('/customer/add-customer') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Pelanggan
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2">
            <i class="bi bi-people-fill" style="color:#b17457;"></i> Daftar Pelanggan
        </h5>
        <span class="badge badge-brand">{{ $data->count() }} pelanggan</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
                <thead><tr>
                    <th>Profil</th><th>Nama</th><th>Email</th><th>No. Telp</th><th>Status</th><th>Aksi</th>
                </tr></thead>
                <tbody>
                    @foreach($data as $customer)
                    <tr>
                        <td style="width:54px;">
                            <img width="40" height="40" class="rounded-circle"
                                style="object-fit:cover;border:2px solid #ede3db;"
                                src="{{ asset('uploads/profile/'.$customer->profile_img) }}" alt="">
                        </td>
                        <td class="fw-600">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                        <td class="text-muted-brand">{{ $customer->email }}</td>
                        <td>{{ $customer->no_telp ?? '-' }}</td>
                        <td>
                            @if($customer->status==='active')
                                <span class="badge bg-success">Aktif</span>
                            @elseif($customer->status==='banned')
                                <span class="badge bg-danger">Banned</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/customer/edit-customer/'.$customer->email) }}"
                                    class="btn btn-sm btn-secondary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <button type="button"
                                        class="btn btn-sm btn-soft-danger btn-delete"
                                        data-form="form-del-cust-{{ md5($customer->email) }}"
                                        data-name="{{ $customer->first_name }} {{ $customer->last_name }}"
                                        data-type="Pelanggan"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <form id="form-del-cust-{{ md5($customer->email) }}"
                                      action="{{ route('customerDelete', $customer->email) }}"
                                      method="post" class="d-none">
                                    @csrf @method('DELETE')
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
