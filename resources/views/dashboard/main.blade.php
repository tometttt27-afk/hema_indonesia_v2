@extends('template.layout-admin')
@section('title_web', 'Dashboard | Hema.Indonesia')
@section('content-admin')

{{-- ═══════════════════════════════════════════════════════
     DASHBOARD ADMIN — Desain terinspirasi Flutter PMO
     Komponen: GradientHeader, InfoCard (pmo-info-card),
               RoleMenuCard (pmo-menu-card), Timeline,
               StatusChip (pmo-chip), AppButton (pmo-app-btn)
══════════════════════════════════════════════════════════ --}}

{{-- ── Gradient Header (customer_dashboard_page.dart) ── --}}
<div class="pmo-gradient-header d-flex align-items-center gap-4">
    <div class="pmo-gh-avatar">
        <svg fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-5.33 0-8 2.67-8 4v1h16v-1c0-1.33-2.67-4-8-4z"/>
        </svg>
    </div>
    <div>
        <p class="pmo-gh-subtitle mb-0">Selamat datang kembali,</p>
        <p class="pmo-gh-title mb-0">{{ auth()->user()->first_name ?? 'Admin' }} &nbsp;👋</p>
    </div>
    <div class="ms-auto text-end" style="flex-shrink:0;">
        <p style="font-size:12px;color:rgba(255,255,255,.65);margin:0;">{{ now()->translatedFormat('l, d F Y') }}</p>
        <p style="font-size:13px;font-weight:700;color:#fff;margin:2px 0 0;">Dashboard Admin</p>
    </div>
</div>

{{-- ── InfoCard Row (info_card.dart) — 4 kartu ringkasan ── --}}
@php
$infoCards = [
    [
        'label'   => 'Total Produk',
        'value'   => number_format($totalProducts),
        'sub'     => $outOfStockCount.' produk stok habis',
        'variant' => 'pmo-ic-brand',
        'svg'     => '<path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>',
    ],
    [
        'label'   => 'Total Pesanan',
        'value'   => number_format($totalOrders),
        'sub'     => ($orderGrowth >= 0 ? '▲' : '▼').abs($orderGrowth).'% vs bulan lalu',
        'variant' => 'pmo-ic-blue',
        'svg'     => '<path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z" opacity=".25"/><path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 5.5h17L18 2H6L3.5 5.5zM5 7v13h14V7H5zm3 3a4 4 0 008 0h-2a2 2 0 01-4 0H8z"/>',
    ],
    [
        'label'   => 'Pelanggan',
        'value'   => number_format($totalCustomers),
        'sub'     => $ordersThisMonth.' pesanan bulan ini',
        'variant' => 'pmo-ic-green',
        'svg'     => '<path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>',
    ],
    [
        'label'   => 'Pendapatan',
        'value'   => 'Rp '.number_format($totalRevenue,0,',','.'),
        'sub'     => 'Bulan ini: Rp '.number_format($revenueThisMonth,0,',','.'),
        'variant' => 'pmo-ic-amber',
        'svg'     => '<path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>',
    ],
];
@endphp

<div class="pmo-stat-row mb-2">
    @foreach($infoCards as $ic)
    <div class="pmo-info-card {{ $ic['variant'] }}">
        <div class="pmo-ic-avatar">
            <svg fill="currentColor" viewBox="0 0 24 24">{!! $ic['svg'] !!}</svg>
        </div>
        <p class="pmo-ic-value">{{ $ic['value'] }}</p>
        <p class="pmo-ic-label">{{ $ic['label'] }}</p>
        <p style="font-size:11px;color:var(--tx-4);margin:4px 0 0;text-align:center;">{{ $ic['sub'] }}</p>
    </div>
    @endforeach
</div>

{{-- ── ROW 2: Stok Menipis + Pesanan Terbaru ── --}}
<div class="row g-3 mb-3">

    {{-- Stok Menipis (admin_product_page + info_card) --}}
    <div class="col-lg-7">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <div class="card-icon-box" style="background:rgba(220,38,38,.10);">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--red);">
                        <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                    </svg>
                </div>
                <h5 class="card-title mb-0">Stok Menipis &amp; Habis</h5>
                <span class="pmo-chip pmo-chip-cancel ms-1">
                    <span class="pmo-chip-dot"></span>{{ $outOfStockCount }} habis
                </span>
                <span class="pmo-chip pmo-chip-pending ms-1">
                    <span class="pmo-chip-dot"></span>&le; {{ $lowStockThreshold }}
                </span>
                <a href="{{ url('/product-list') }}" class="btn-text ms-auto">Lihat Semua →</a>
            </div>
            <div class="card-body p-0">
                @if($lowStockProducts->isEmpty())
                    <div class="text-center py-5">
                        <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24"
                             style="color:var(--green);opacity:.35;display:block;margin:0 auto 12px;">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <p class="mb-0" style="color:var(--tx-3);font-size:13.5px;">Semua stok dalam kondisi aman.</p>
                    </div>
                @else
                    <div class="p-3 d-flex flex-column gap-1">
                        @foreach($lowStockProducts as $p)
                        {{-- ProductCard style (product_card.dart) --}}
                        <div class="pmo-product-card">
                            <div class="pmo-pc-img">
                                <img src="{{ asset('uploads/products/'.$p->image) }}" alt="{{ $p->name }}">
                            </div>
                            <div class="pmo-pc-body">
                                <p class="pmo-pc-name">{{ $p->name }}</p>
                                <p style="font-size:11.5px;color:var(--tx-4);margin:2px 0 0;">
                                    {{ optional($p->categories)->name ?? '—' }}
                                </p>
                            </div>
                            <div class="text-end" style="flex-shrink:0;">
                                <p class="fw-700 mb-1" style="font-size:14px;color:var(--tx-1);">{{ $p->stock }}</p>
                                @if($p->stock <= 0)
                                    <span class="pmo-chip pmo-chip-cancel">
                                        <span class="pmo-chip-dot"></span>Habis
                                    </span>
                                @else
                                    <span class="pmo-chip pmo-chip-pending">
                                        <span class="pmo-chip-dot"></span>Menipis
                                    </span>
                                @endif
                            </div>
                            <a href="{{ url('/product-list/edit-product-list/'.strtolower($p->code_product)) }}"
                               class="btn btn-sm btn-primary ms-2"
                               aria-label="Tambah stok {{ $p->name }}" title="Tambah Stok">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                </svg>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Pesanan Terbaru (role_menu_card style) --}}
    <div class="col-lg-5">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <div class="card-icon-box" style="background:rgba(37,99,235,.10);">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--blue);">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/>
                    </svg>
                </div>
                <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                <a href="{{ url('/order-list') }}" class="btn-text ms-auto">Semua →</a>
            </div>
            <div class="card-body p-3">
                @if($recentOrders->isEmpty())
                    <div class="text-center py-4">
                        <svg width="40" height="40" fill="currentColor" viewBox="0 0 24 24"
                             style="color:var(--c-light);opacity:.4;display:block;margin:0 auto 10px;">
                            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z"/>
                        </svg>
                        <p style="color:var(--tx-3);font-size:13px;margin:0;">Belum ada pesanan.</p>
                    </div>
                @else
                    @php
                    $sLabel=['pending'=>'Menunggu','paid'=>'Dibayar','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Batal'];
                    $sChip =['pending'=>'pmo-chip-pending','paid'=>'pmo-chip-paid','shipped'=>'pmo-chip-ship','completed'=>'pmo-chip-success','cancelled'=>'pmo-chip-cancel'];
                    @endphp
                    <div class="d-flex flex-column gap-2">
                        @foreach($recentOrders as $ro)
                        {{-- RoleMenuCard style (role_menu_card.dart) --}}
                        <a href="{{ url('/order-list/'.$ro->id) }}"
                           class="pmo-menu-card pmo-mc-brand text-decoration-none py-2"
                           style="margin-bottom:0;">
                            <div class="pmo-mc-icon" style="background:rgba(121,85,72,.10);width:38px;height:38px;">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24" style="color:var(--c-mid);">
                                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z" opacity=".25"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 5.5h17L18 2H6L3.5 5.5zM5 7v13h14V7H5z"/>
                                </svg>
                            </div>
                            <div class="pmo-mc-body">
                                <p class="pmo-mc-title" style="font-size:13px;">#{{ $ro->id }} — {{ optional($ro->user)->first_name }}</p>
                                <p class="pmo-mc-subtitle">
                                    Rp {{ number_format($ro->total_price,0,',','.') }}
                                    &bull; {{ $ro->created_at->format('d M H:i') }}
                                </p>
                            </div>
                            <span class="pmo-chip {{ $sChip[$ro->status] ?? 'pmo-chip-brand' }}">
                                <span class="pmo-chip-dot"></span>
                                {{ $sLabel[$ro->status] ?? $ro->status }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ── ROW 3: Menu Pengelolaan + Status Pesanan ── --}}
<div class="row g-3">

    {{-- Menu Pengelolaan (role_menu_card.dart admin) --}}
    <div class="col-lg-5">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <div class="card-icon-box" style="background:rgba(121,85,72,.10);">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--c-mid);">
                        <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
                    </svg>
                </div>
                <h5 class="card-title mb-0">Menu Pengelolaan</h5>
            </div>
            <div class="card-body">
                @php
                $menus = [
                    ['url'=>'/product-list',   'title'=>'Kelola Produk',    'sub'=>'Tambah, edit, hapus & update stok',     'variant'=>'pmo-mc-brand',  'svg'=>'<path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>'],
                    ['url'=>'/order-list',     'title'=>'Semua Transaksi',  'sub'=>'Lihat seluruh transaksi customer',      'variant'=>'pmo-mc-green',  'svg'=>'<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>'],
                    ['url'=>'/order-list',     'title'=>'Semua Pengiriman', 'sub'=>'Lihat seluruh data & status pengiriman', 'variant'=>'pmo-mc-amber',  'svg'=>'<path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z"/>'],
                    ['url'=>'/about-company',  'title'=>'Laporan & Konten', 'sub'=>'Generate laporan & kelola konten web',  'variant'=>'pmo-mc-purple', 'svg'=>'<path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/>'],
                ];
                @endphp
                @foreach($menus as $m)
                <a href="{{ url($m['url']) }}" class="pmo-menu-card {{ $m['variant'] }}">
                    <div class="pmo-mc-icon">
                        <svg fill="currentColor" viewBox="0 0 24 24">{!! $m['svg'] !!}</svg>
                    </div>
                    <div class="pmo-mc-body">
                        <p class="pmo-mc-title">{{ $m['title'] }}</p>
                        <p class="pmo-mc-subtitle">{{ $m['sub'] }}</p>
                    </div>
                    <svg class="pmo-mc-arrow" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Status Distribusi + Revenue Card --}}
    <div class="col-lg-7">

        {{-- Revenue Card (admin_dashboard deepPurple) --}}
        <div class="pmo-revenue-card mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <p class="pmo-rc-label">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                        </svg>
                        Total Pendapatan
                    </p>
                    <p class="pmo-rc-value">Rp {{ number_format($totalRevenue,0,',','.') }}</p>
                    <p class="pmo-rc-sub">Bulan ini: Rp {{ number_format($revenueThisMonth,0,',','.') }}</p>
                </div>
                <div style="text-align:right;flex-shrink:0;">
                    <span class="pmo-chip pmo-chip-success" style="background:rgba(255,255,255,.18);color:#fff;">
                        <span class="pmo-chip-dot" style="background:#fff;"></span>
                        {{ ($orderGrowth >= 0 ? '+' : '').$orderGrowth }}% bulan ini
                    </span>
                </div>
            </div>
        </div>

        {{-- Status Pesanan (admin_shipment_page timeline) --}}
        <div class="card mb-0">
            <div class="card-header">
                <div class="card-icon-box" style="background:rgba(121,85,72,.10);">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--c-mid);">
                        <path d="M5 9.2h3V19H5V9.2zM10.6 5h2.8v14h-2.8V5zm5.6 8H19v6h-2.8v-6z"/>
                    </svg>
                </div>
                <h5 class="card-title mb-0">Distribusi Status Pesanan</h5>
            </div>
            <div class="card-body">
                @php
                $statusMeta = [
                    'pending'  => ['label'=>'Menunggu Bayar','color'=>'var(--s-pending-tx)',   'bg'=>'var(--s-pending-bg)'],
                    'paid'     => ['label'=>'Sudah Dibayar', 'color'=>'var(--s-paid-tx)',      'bg'=>'var(--s-paid-bg)'],
                    'shipped'  => ['label'=>'Dikirim',       'color'=>'var(--s-shipped-tx)',   'bg'=>'var(--s-shipped-bg)'],
                    'completed'=> ['label'=>'Selesai',       'color'=>'var(--s-completed-tx)', 'bg'=>'var(--s-completed-bg)'],
                    'cancelled'=> ['label'=>'Dibatalkan',    'color'=>'var(--s-cancelled-tx)', 'bg'=>'var(--s-cancelled-bg)'],
                ];
                $grandTotal = max(array_sum($ordersByStatus), 1);
                @endphp
                @foreach($statusMeta as $key => $meta)
                @php $count = $ordersByStatus[$key] ?? 0; $pct = round($count / $grandTotal * 100); @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span style="font-size:12.5px;font-weight:600;color:var(--tx-2);">{{ $meta['label'] }}</span>
                        <div class="d-flex align-items-center gap-2">
                            <span style="font-size:12px;font-weight:700;color:{{ $meta['color'] }};">{{ $count }}</span>
                            <span class="pmo-chip" style="background:{{ $meta['bg'] }};color:{{ $meta['color'] }};padding:2px 8px;font-size:10.5px;">
                                {{ $pct }}%
                            </span>
                        </div>
                    </div>
                    <div style="height:8px;border-radius:50px;background:var(--bd-lt);overflow:hidden;">
                        <div style="height:100%;border-radius:50px;width:{{ $pct }}%;background:{{ $meta['color'] }};transition:width .5s ease;"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>{{-- /row 3 --}}
@endsection
