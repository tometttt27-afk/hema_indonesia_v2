@extends('template.layout-main')
@section('title_web', 'Pesanan Saya | Hema.Indonesia')
@section('content-main')
@php
    $statusBg=['pending'=>'status-pending','paid'=>'status-paid','shipped'=>'status-shipped','completed'=>'status-completed','cancelled'=>'status-cancelled'];
    $statusLabel=['pending'=>'Menunggu Pembayaran','paid'=>'Dibayar','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Dibatalkan'];
@endphp

<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list"><li><a href="{{ url('/') }}">Beranda</a></li><li>Pesanan</li></ol>
        <h2 class="page-hero">Pesanan <span style="color:#b17457;">Saya</span></h2>
        <p>Riwayat dan status semua pesanan Anda</p>
    </div>
</div>

<section class="container py-14">
    @if($data->isEmpty())
        <div class="empty-state max-w-md mx-auto">
            <i class="fas fa-box-open"></i>
            <p>Anda belum memiliki pesanan.</p>
            <a href="{{ url('/product') }}" class="btn-brand mt-4 inline-flex">Mulai Belanja</a>
        </div>
    @else
        <div class="flex flex-col gap-4">
            @foreach($data as $order)
            <div class="rounded-xl p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 transition-all duration-200"
                style="background:#fff;border:1.5px solid #ede3db;"
                onmouseover="this.style.boxShadow='0 4px 18px rgba(177,116,87,.1)';this.style.borderColor='#d4a882';"
                onmouseout="this.style.boxShadow='none';this.style.borderColor='#ede3db';">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                        style="background:rgba(177,116,87,.08);">
                        <i class="fas fa-bag-shopping" style="color:#b17457;font-size:18px;"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            <span class="font-bold text-gray-900">Pesanan #{{ $order->id }}</span>
                            <span class="status-badge {{ $statusBg[$order->status]??'bg-gray-100 text-gray-600' }}">
                                {{ $statusLabel[$order->status]??$order->status }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500">
                            {{ $order->created_at->format('d M Y H:i') }} &bull;
                            {{ $order->details->count() }} produk &bull;
                            <strong style="color:#b17457;">Rp. {{ number_format($order->total_price,0,',','.') }}</strong>
                        </p>
                    </div>
                </div>
                <a href="{{ url('/orders/'.$order->id) }}" class="btn-outline-brand text-sm px-5 py-2 shrink-0">
                    Lihat Detail <i class="fas fa-arrow-right text-xs ms-1"></i>
                </a>
            </div>
            @endforeach
        </div>
    @endif
</section>

@endsection
