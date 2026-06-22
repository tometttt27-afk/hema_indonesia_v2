@extends('template.layout-admin')
@section('title_web', 'Data Pesanan | Hema.Indonesia')
@section('content-admin')
    @php
        $badgeClass = [
            'pending'   => 'bg-warning text-dark',
            'paid'      => 'bg-info text-white',
            'shipped'   => 'bg-primary',
            'completed' => 'bg-success',
            'cancelled' => 'bg-danger',
        ];
        $label = [
            'pending'   => 'Menunggu Pembayaran',
            'paid'      => 'Dibayar',
            'shipped'   => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
    @endphp
    <div class="page-header">
        <div class="page-title">
            <h4>Data Pesanan</h4>
            <h6>Kelola semua pesanan pelanggan</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $order)
                            <tr>
                                <td class="fw-500">#{{ $order->id }}</td>
                                <td>
                                    <div>
                                        <p class="mb-0 fw-500">{{ optional($order->user)->first_name }} {{ optional($order->user)->last_name }}</p>
                                        <small class="text-muted">{{ optional($order->user)->email }}</small>
                                    </div>
                                </td>
                                <td><strong>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
                                <td class="text-muted" style="font-size:13px;">{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>{{ $order->payment_type ? ucfirst(str_replace('_', ' ', $order->payment_type)) : '-' }}</td>
                                <td>
                                    <span class="badge {{ $badgeClass[$order->status] ?? 'bg-secondary' }}">
                                        {{ $label[$order->status] ?? $order->status }}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ url('/order-list/' . $order->id) }}">
                                        <i class="bi bi-eye me-1"></i> Detail
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
