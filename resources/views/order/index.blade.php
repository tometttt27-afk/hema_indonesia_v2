@extends('template.layout-admin')
@section('title_web', 'Data Pesanan | Hema.Indonesia')
@section('content-admin')
@php
    $badgeClass=['pending'=>'bg-warning text-dark','paid'=>'bg-info','shipped'=>'bg-primary','completed'=>'bg-success','cancelled'=>'bg-danger'];
    $label=['pending'=>'Menunggu','paid'=>'Dibayar','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Dibatalkan'];
@endphp

<div class="page-header">
    <div class="page-title">
        <h4>Data Pesanan</h4>
        <h6>Kelola semua pesanan pelanggan</h6>
    </div>
    <span class="badge badge-brand">{{ $data->count() }} pesanan</span>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2">
            <i class="bi bi-bag-check-fill" style="color:#b17457;"></i> Daftar Pesanan
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
                <thead><tr>
                    <th>#</th><th>Pelanggan</th><th>Total</th>
                    <th>Tanggal</th><th>Pembayaran</th><th>Status</th><th>Aksi</th>
                </tr></thead>
                <tbody>
                    @foreach($data as $order)
                    <tr>
                        <td class="fw-700" style="color:#b17457;">#{{ $order->id }}</td>
                        <td>
                            <div>
                                <p class="mb-0 fw-600" style="font-size:13.5px;">{{ optional($order->user)->first_name }} {{ optional($order->user)->last_name }}</p>
                                <p class="mb-0 text-muted-brand" style="font-size:12px;">{{ optional($order->user)->email }}</p>
                            </div>
                        </td>
                        <td><strong>Rp. {{ number_format($order->total_price,0,',','.') }}</strong></td>
                        <td class="text-muted-brand" style="font-size:12.5px;">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="text-muted-brand">{{ $order->payment_type ? ucfirst(str_replace('_',' ',$order->payment_type)) : '-' }}</td>
                        <td>
                            <span class="badge {{ $badgeClass[$order->status]??'bg-secondary' }}">
                                {{ $label[$order->status]??$order->status }}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ url('/order-list/'.$order->id) }}">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
