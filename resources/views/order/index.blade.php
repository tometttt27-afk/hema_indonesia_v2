@extends('template.layout-admin')
@section('title_web', 'Data Pesanan | Hema.Indonesia')
@section('content-admin')

@php
/* FIX: badge class konsisten — semua pakai badge-* bukan bg-* Bootstrap */
$badgeCls = [
    'pending'   => 'badge-pending',
    'paid'      => 'badge-paid',
    'shipped'   => 'badge-shipped',
    'completed' => 'badge-completed',
    'cancelled' => 'badge-cancelled',
];
$label = [
    'pending'   => 'Menunggu',
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
    <span class="badge badge-brand">{{ $data->count() }} pesanan</span>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center gap-2">
            {{-- icon bag siluet --}}
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z" opacity=".25"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 5.5h17L18 2H6L3.5 5.5zM5 7v13h14V7H5zm3 3a4 4 0 008 0h-2a2 2 0 01-4 0H8z"/>
            </svg>
            <h5 class="card-title mb-0">Daftar Pesanan</h5>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
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
                    @forelse($data as $order)
                    <tr>
                        <td class="fw-700" style="color:var(--br);">#{{ $order->id }}</td>
                        <td>
                            <div>
                                <p class="mb-0 fw-600" style="font-size:13px;">
                                    {{ optional($order->user)->first_name }} {{ optional($order->user)->last_name }}
                                </p>
                                <p class="mb-0 text-muted-brand" style="font-size:12px;">
                                    {{ optional($order->user)->email }}
                                </p>
                            </div>
                        </td>
                        <td><strong>Rp {{ number_format($order->total_price,0,',','.') }}</strong></td>
                        <td class="text-muted-brand" style="font-size:12.5px;">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="text-muted-brand">
                            {{ $order->payment_type ? ucfirst(str_replace('_',' ',$order->payment_type)) : '-' }}
                        </td>
                        <td>
                            {{-- FIX: badge class konsisten pakai badge-* --}}
                            <span class="badge {{ $badgeCls[$order->status] ?? 'badge-brand' }}">
                                {{ $label[$order->status] ?? $order->status }}
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               href="{{ url('/order-list/'.$order->id) }}"
                               aria-label="Lihat detail pesanan #{{ $order->id }}">
                                {{-- icon eye siluet --}}
                                <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 100 6 3 3 0 000-6z"/>
                                </svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <svg width="44" height="44" fill="currentColor" viewBox="0 0 24 24"
                                 style="color:var(--br-lt);opacity:.4;display:block;margin:0 auto 10px;">
                                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z"/>
                            </svg>
                            <p style="color:var(--tx-3);">Belum ada pesanan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
