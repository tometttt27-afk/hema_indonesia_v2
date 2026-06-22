@extends('template.layout-admin')
@section('title_web', 'Data Pelanggan | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Data Pelanggan</h4>
            <h6>Kelola data pelanggan terdaftar</h6>
        </div>
        <div class="page-btn">
            <a href="{{ url('/customer/add-customer') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Pelanggan
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>Profil</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $customer)
                            <tr>
                                <td>
                                    <img width="42" height="42" class="rounded-circle"
                                        style="object-fit:cover;border:2px solid #e8ddd7;"
                                        src="{{ asset('uploads/profile/' . $customer->profile_img) }}"
                                        alt="Profile">
                                </td>
                                <td class="fw-500">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                <td class="text-muted">{{ $customer->email }}</td>
                                <td>{{ $customer->no_telp ?? '-' }}</td>
                                <td>
                                    @if ($customer->status === 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif ($customer->status === 'banned')
                                        <span class="badge bg-danger">Banned</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ url('/customer/edit-customer/' . $customer->email) }}"
                                            class="btn btn-sm" style="background:#f3ede9;border:1px solid #e8ddd7;" title="Edit">
                                            <i class="bi bi-pencil" style="color:#b17457;"></i>
                                        </a>
                                        <form action="{{ route('customerDelete', $customer->email) }}" method="post">
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
