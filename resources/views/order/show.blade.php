@extends('template.layout-admin')
@section('title_web', 'Detail Pesanan | Hema.Indonesia')
@section('content-admin')
@php
    $badgeClass=['pending'=>'bg-warning text-dark','paid'=>'bg-info','shipped'=>'bg-primary','completed'=>'bg-success','cancelled'=>'bg-danger'];
    $label=['pending'=>'Menunggu Pembayaran','paid'=>'Dibayar','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Dibatalkan'];
    $sColor=['pending'=>'#f59e0b','paid'=>'#6366f1','shipped'=>'#8b5cf6','completed'=>'#10b981','cancelled'=>'#ef4444'];
@endphp

<div class="page-header">
    <div class="page-title">
        <h4>Pesanan <span style="color:#b17457;">#{{ $data->id }}</span></h4>
        <h6>
            <span class="badge {{ $badgeClass[$data->status]??'bg-secondary' }}">{{ $label[$data->status]??$data->status }}</span>
            &nbsp;&bull;&nbsp;{{ $data->created_at->format('d M Y, H:i') }}
        </h6>
    </div>
    <a href="{{ url('/order-list') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-3">
    {{-- Products --}}
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-bag2 me-1" style="color:#b17457;"></i> Produk Dipesan
                </h5>
                <span class="badge badge-brand">{{ $data->details->count() }} item</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead><tr><th>Produk</th><th>Ukuran</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr></thead>
                        <tbody>
                            @foreach($data->details as $detail)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('uploads/products/'.optional($detail->product)->image) }}"
                                            style="width:44px;height:44px;object-fit:cover;border-radius:8px;border:1px solid #ede3db;" alt="">
                                        <span class="fw-500">{{ optional($detail->product)->name ?? 'Produk dihapus' }}</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-brand text-uppercase">{{ $detail->size }}</span></td>
                                <td>Rp. {{ number_format($detail->price,0,',','.') }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td><strong>Rp. {{ number_format($detail->price*$detail->quantity,0,',','.') }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background:#faf0ea;">
                                <th colspan="4" class="text-end">Total Pembayaran</th>
                                <th style="color:#b17457;font-size:15px;">Rp. {{ number_format($data->total_price,0,',','.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Side panels --}}
    <div class="col-lg-4">
        {{-- Customer info --}}
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="bi bi-person me-2" style="color:#b17457;"></i>Data Pelanggan</h5>
            </div>
            <div class="card-body">
                @php $u = $data->user; @endphp
                <table class="table table-borderless mb-0" style="font-size:13.5px;">
                    <tr><td class="text-muted-brand ps-0" style="width:80px;">Nama</td><td class="fw-600">{{ optional($u)->first_name }} {{ optional($u)->last_name }}</td></tr>
                    <tr><td class="text-muted-brand ps-0">Email</td><td>{{ optional($u)->email }}</td></tr>
                    <tr><td class="text-muted-brand ps-0">Telp</td><td>{{ optional($u)->no_telp ?? '-' }}</td></tr>
                    <tr><td class="text-muted-brand ps-0 align-top">Alamat</td><td>{{ optional($u)->address ?? '-' }}</td></tr>
                </table>
            </div>
        </div>

        {{-- Update status --}}
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="bi bi-arrow-repeat me-2" style="color:#b17457;"></i>Ubah Status</h5>
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
                    <button type="submit" class="btn btn-primary w-100">Perbarui Status</button>
                </form>
            </div>
        </div>

        {{-- Shipping --}}
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="bi bi-truck me-2" style="color:#b17457;"></i>Pengiriman</h5>
            </div>
            <div class="card-body">
                <div style="font-size:13.5px;margin-bottom:16px;">
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
                        <input type="text" name="tracking_number" value="{{ $data->tracking_number }}" placeholder="Masukkan no. resi" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i> Simpan Resi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
