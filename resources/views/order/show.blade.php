@extends('template.layout-admin')
@section('title_web', 'Detail Pesanan | Hema.Indonesia')
@section('content-admin')

@php
$badgeCls = ['pending'=>'badge-pending','paid'=>'badge-paid','shipped'=>'badge-shipped','completed'=>'badge-completed','cancelled'=>'badge-cancelled'];
$label    = ['pending'=>'Menunggu Pembayaran','paid'=>'Dibayar','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Dibatalkan'];
@endphp

{{-- Breadcrumb + page header --}}
<div class="page-header">
    <div class="page-title">
        <nav class="breadcrumb-admin">
            <a href="{{ url('/order-list') }}">Pesanan</a>
            <span class="sep">/</span>
            <span class="current">Detail #{{ $data->id }}</span>
        </nav>
        <h4>Pesanan <span style="color:var(--br);">#{{ $data->id }}</span></h4>
        <h6>
            <span class="badge {{ $badgeCls[$data->status] ?? 'badge-brand' }}">
                {{ $label[$data->status] ?? $data->status }}
            </span>
            &nbsp;&bull;&nbsp;{{ $data->created_at->format('d M Y, H:i') }}
        </h6>
    </div>
    <a href="{{ url('/order-list') }}" class="btn btn-secondary">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
        Kembali
    </a>
</div>

<div class="row g-3">

    {{-- Kolom kiri: Produk Dipesan --}}
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    {{-- icon bag siluet --}}
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z" opacity=".25"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 5.5h17L18 2H6L3.5 5.5zM5 7v13h14V7H5zm3 3a4 4 0 008 0h-2a2 2 0 01-4 0H8z"/>
                    </svg>
                    <h5 class="card-title mb-0">Produk Dipesan</h5>
                </div>
                <span class="badge badge-brand">{{ $data->details->count() }} item</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr><th>Produk</th><th>Ukuran</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
                        </thead>
                        <tbody>
                            @foreach($data->details as $detail)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('uploads/products/'.optional($detail->product)->image) }}"
                                             style="width:44px;height:44px;object-fit:cover;border-radius:8px;border:1px solid var(--bd);" alt="">
                                        <span class="fw-500" style="font-size:13px;">{{ optional($detail->product)->name ?? 'Produk dihapus' }}</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-brand text-uppercase">{{ $detail->size }}</span></td>
                                <td>Rp {{ number_format($detail->price,0,',','.') }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td><strong>Rp {{ number_format($detail->price * $detail->quantity,0,',','.') }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total Pembayaran</th>
                                <th style="color:var(--br);font-size:15px;">
                                    Rp {{ number_format($data->total_price,0,',','.') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: Info Customer + Status + Pengiriman --}}
    <div class="col-lg-4">

        {{-- Data Pelanggan --}}
        <div class="card mb-3">
            <div class="card-header">
                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                    <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-5.33 0-8 2.67-8 4v1h16v-1c0-1.33-2.67-4-8-4z"/>
                </svg>
                <h5 class="card-title mb-0">Data Pelanggan</h5>
            </div>
            <div class="card-body">
                @php $u = $data->user; @endphp
                <table class="table table-borderless mb-0" style="font-size:13px;">
                    <tr><td class="text-muted-brand ps-0" style="width:75px;">Nama</td>
                        <td class="fw-600">{{ optional($u)->first_name }} {{ optional($u)->last_name }}</td></tr>
                    <tr><td class="text-muted-brand ps-0">Email</td>
                        <td>{{ optional($u)->email }}</td></tr>
                    <tr><td class="text-muted-brand ps-0">Telp</td>
                        <td>{{ optional($u)->no_telp ?? '-' }}</td></tr>
                    <tr><td class="text-muted-brand ps-0 align-top">Alamat</td>
                        <td>{{ optional($u)->address ?? '-' }}</td></tr>
                </table>
            </div>
        </div>

        {{-- Ubah Status --}}
        <div class="card mb-3">
            <div class="card-header">
                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                    <path d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6 0 1.01-.25 1.97-.7 2.8l1.46 1.46A7.93 7.93 0 0020 12c0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6 0-1.01.25-1.97.7-2.8L5.24 7.74A7.93 7.93 0 004 12c0 4.42 3.58 8 8 8v3l4-4-4-4v3z"/>
                </svg>
                <h5 class="card-title mb-0">Ubah Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('orderStatusPut', $data->id) }}" method="post">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label>Status Pesanan</label>
                        <select class="form-control" name="status">
                            @foreach($label as $key => $text)
                                <option value="{{ $key }}" {{ $data->status==$key?'selected':'' }}>{{ $text }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                        Perbarui Status
                    </button>
                </form>
            </div>
        </div>

        {{-- Pengiriman --}}
        <div class="card">
            <div class="card-header">
                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                    <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                </svg>
                <h5 class="card-title mb-0">Pengiriman</h5>
            </div>
            <div class="card-body">
                <div style="font-size:13px;margin-bottom:16px;">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted-brand">Metode</span>
                        <span class="fw-500">{{ $data->payment_type ? ucfirst(str_replace('_',' ',$data->payment_type)) : '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted-brand">Dibayar</span>
                        <span class="fw-500">{{ $data->paid_at ? $data->paid_at->format('d M Y H:i') : '-' }}</span>
                    </div>
                </div>
                <form action="{{ route('orderTrackingPut', $data->id) }}" method="post">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label>Nomor Resi</label>
                        <input type="text" name="tracking_number" value="{{ $data->tracking_number }}"
                               placeholder="Masukkan nomor resi pengiriman" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"/></svg>
                        Simpan Resi
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
