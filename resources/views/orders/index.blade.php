@extends('template.layout-main')
@section('title_web', 'Pesanan Saya | Hema.Indonesia')
@section('content-main')
    @php
        $badge = [
            'pending' => 'bg-yellow-100 text-yellow-700',
            'paid' => 'bg-blue-100 text-blue-700',
            'shipped' => 'bg-indigo-100 text-indigo-700',
            'completed' => 'bg-green-100 text-green-700',
            'cancelled' => 'bg-red-100 text-red-700',
        ];
        $label = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Dibayar',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
    @endphp
    <div id="hero" class="header-hero bg-[#f5f5f5]">
        <div class="container pt-10 pb-11">
            <nav aria-label="breadcrumb" class="w-full">
                <ol class="flex w-full flex-wrap items-center mb-2">
                    <li class="flex items-center text-sm text-gray-500 hover:text-slate-800">
                        <a href="{{ url('/') }}">Beranda</a>
                        <span class="pointer-events-none mx-2 text-slate-800">/</span>
                    </li>
                    <li class="flex items-center text-sm text-gray-500 hover:text-slate-800">
                        <a href="{{ url('/orders') }}">Pesanan</a>
                    </li>
                </ol>
            </nav>
            <h2 class="text-[20px] md:text-2xl font-bold">Pesanan <span class="text-primary">Saya</span></h2>
            <p class="text-gray-500">Riwayat dan status pesanan anda</p>
        </div>
    </div>

    <section class="container py-16">
        @if ($data->isEmpty())
            <div class="text-center py-20 border border-gray-200 rounded">
                <i class="fas fa-box-open text-4xl text-gray-300"></i>
                <p class="mt-4 text-gray-500">Anda belum memiliki pesanan.</p>
                <a href="{{ url('/product') }}"
                    class="inline-block mt-4 bg-gradient-to-r from-primary to-secondary text-white text-sm font-medium rounded-sm px-6 py-[10px] hover:opacity-90">Mulai
                    Belanja</a>
            </div>
        @else
            <div class="flex flex-col gap-4">
                @foreach ($data as $order)
                    <div class="border border-gray-200 rounded p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <h3 class="font-semibold">Pesanan #{{ $order->id }}</h3>
                                <span
                                    class="text-[11px] px-3 py-1 rounded-full {{ $badge[$order->status] ?? 'bg-gray-100 text-gray-700' }}">{{ $label[$order->status] ?? $order->status }}</span>
                            </div>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }} &middot;
                                {{ $order->details->count() }} produk &middot; Rp.
                                {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ url('/orders/' . $order->id) }}"
                            class="text-sm border border-primary text-primary rounded-sm px-5 py-2 hover:bg-primary hover:text-white text-center">Lihat
                            Detail</a>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endsection
