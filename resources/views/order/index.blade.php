@extends('template.layout-admin')
@section('title_web', 'Data Pesanan | Hema.Indonesia')
@section('content-admin')
    @php
        $badge = [
            'pending' => 'badge bg-warning',
            'paid' => 'badge bg-info',
            'shipped' => 'badge bg-primary',
            'completed' => 'badge bg-success',
            'cancelled' => 'badge bg-danger',
        ];
        $label = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Dibayar',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
    @endphp
    <div class="page-header">
        <div class="page-title">
            <h4>Data Pesanan</h4>
            <h6>Kelola pesanan pelanggan</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ optional($order->user)->first_name }} {{ optional($order->user)->last_name }}</td>
                                <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td><span
                                        class="{{ $badge[$order->status] ?? 'badge bg-secondary' }}">{{ $label[$order->status] ?? $order->status }}</span>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ url('/order-list/' . $order->id) }}">
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
