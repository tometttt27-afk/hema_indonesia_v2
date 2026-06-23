@extends('template.layout-admin')
@section('title_web', 'Data Pelanggan | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Data Pelanggan</h4>
        <h6>Kelola akun pelanggan terdaftar</h6>
    </div>
    <a href="{{ url('/customer/add-customer') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
        Tambah Pelanggan
    </a>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
            <h5 class="card-title mb-0">Daftar Pelanggan</h5>
        </div>
        <span class="badge badge-brand">{{ $data->count() }} pelanggan</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
                <thead>
                    <tr>
                        <th>Profil</th><th>Nama</th><th>Email</th>
                        <th>No. Telp</th><th>Status</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $customer)
                    <tr>
                        <td style="width:54px;">
                            <img width="40" height="40" class="rounded-circle"
                                 src="{{ asset('uploads/profile/'.$customer->profile_img) }}" alt="">
                        </td>
                        <td class="fw-600">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                        <td class="text-muted-brand">{{ $customer->email }}</td>
                        <td>{{ $customer->no_telp ?? '-' }}</td>
                        <td>
                            @if($customer->status === 'active')
                                <span class="badge badge-completed">Aktif</span>
                            @elseif($customer->status === 'banned')
                                <span class="badge badge-cancelled">Banned</span>
                            @else
                                <span class="badge" style="background:#f1f5f9;color:#475569;">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/customer/edit-customer/'.$customer->email) }}"
                                   class="btn btn-sm btn-secondary"
                                   aria-label="Edit pelanggan {{ $customer->first_name }}"
                                   title="Edit pelanggan">
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-soft-danger btn-delete"
                                        data-form="form-del-cust-{{ md5($customer->email) }}"
                                        data-name="{{ $customer->first_name }} {{ $customer->last_name }}"
                                        data-type="Pelanggan"
                                        aria-label="Hapus pelanggan {{ $customer->first_name }}"
                                        title="Hapus pelanggan">
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                    </svg>
                                </button>
                                <form id="form-del-cust-{{ md5($customer->email) }}"
                                      action="{{ route('customerDelete', $customer->email) }}"
                                      method="post" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <svg width="44" height="44" fill="currentColor" viewBox="0 0 24 24"
                                 style="color:var(--br-lt);opacity:.4;display:block;margin:0 auto 10px;">
                                <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-5.33 0-8 2.67-8 4v1h16v-1c0-1.33-2.67-4-8-4z"/>
                            </svg>
                            <p style="color:var(--tx-3);">Belum ada pelanggan terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
