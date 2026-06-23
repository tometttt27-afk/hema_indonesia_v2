@extends('template.layout-admin')
@section('title_web', 'Dashboard | Hema.Indonesia')
@section('content-admin')

{{-- ── STAT CARDS ── --}}
@php
$stats = [
    ['label'=>'Total Produk',  'value'=>number_format($totalProducts),
     'sub'=>$outOfStockCount.' stok habis',
     'cls_card'=>'stat-card-brand', 'cls_icon'=>'stat-icon-brand', 'color'=>'var(--br)'],
    ['label'=>'Total Pesanan', 'value'=>number_format($totalOrders),
     'sub'=>($orderGrowth>=0?'▲':'▼').abs($orderGrowth).'% vs bulan lalu',
     'cls_card'=>'stat-card-blue',  'cls_icon'=>'stat-icon-blue',  'color'=>'var(--blue)'],
    ['label'=>'Pelanggan',     'value'=>number_format($totalCustomers),
     'sub'=>$ordersThisMonth.' pesanan bulan ini',
     'cls_card'=>'stat-card-green', 'cls_icon'=>'stat-icon-green', 'color'=>'var(--green)'],
    ['label'=>'Pendapatan',    'value'=>'Rp '.number_format($totalRevenue,0,',','.'),
     'sub'=>'Bulan ini: Rp '.number_format($revenueThisMonth,0,',','.'),
     'cls_card'=>'stat-card-amber', 'cls_icon'=>'stat-icon-amber', 'color'=>'var(--amber)'],
];
$statIcons = [
    '<path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>',
    '<path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z" opacity=".25"/><path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 5.5L6.2 2h11.6l2.7 3.5H3.5zM5 7v13h14V7H5zm3 3a4 4 0 008 0h-2a2 2 0 01-4 0H8z"/>',
    '<path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>',
    '<path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>',
];
@endphp

<div class="row g-3 mb-4">
    @foreach($stats as $i => $s)
    <div class="col-xl-3 col-sm-6">
        <div class="card mb-0 border-0 {{ $s['cls_card'] }}">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center {{ $s['cls_icon'] }}"
                     style="width:48px;height:48px;border-radius:12px;">
                    <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"
                         style="color:{{ $s['color'] }};">{!! $statIcons[$i] !!}</svg>
                </div>
                <div class="overflow-hidden">
                    <div class="fw-800 mb-0 text-truncate"
                         style="color:{{ $s['color'] }};font-size:22px;line-height:1.1;">
                        {{ $s['value'] }}
                    </div>
                    <div class="text-muted-brand fw-600" style="font-size:12px;">{{ $s['label'] }}</div>
                    <div style="font-size:11px;color:var(--tx-4);margin-top:1px;">{{ $s['sub'] }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- ── ROW 2: Stok Menipis + Pesanan Terbaru ── --}}
<div class="row g-3 mb-4">

    {{-- Stok Menipis --}}
    <div class="col-lg-8">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <div class="card-icon-box" style="background:rgba(220,38,38,.10);">
                    {{-- icon warning siluet --}}
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--red);">
                        <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                    </svg>
                </div>
                <h5 class="card-title mb-0">Stok Menipis &amp; Habis</h5>
                <span class="chip chip-red">{{ $outOfStockCount }} habis</span>
                <span class="chip chip-amber ms-1">ambang &le; {{ $lowStockThreshold }}</span>
                <a href="{{ url('/product-list') }}" class="btn-text ms-1">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @if($lowStockProducts->isEmpty())
                    <div class="text-center py-5">
                        {{-- icon check siluet --}}
                        <svg width="44" height="44" fill="currentColor" viewBox="0 0 24 24"
                             style="color:var(--green);opacity:.4;margin:0 auto 10px;">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <p class="mb-0 text-muted-brand" style="font-size:13.5px;">Semua stok dalam kondisi aman.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead><tr><th>Produk</th><th>Kategori</th><th>Stok</th><th>Status</th><th>Aksi</th></tr></thead>
                            <tbody>
                                @foreach($lowStockProducts as $p)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('uploads/products/'.$p->image) }}"
                                                 style="width:36px;height:36px;object-fit:cover;border-radius:6px;border:1px solid var(--bd);" alt="">
                                            <span class="fw-600" style="font-size:13px;">{{ $p->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-muted-brand">{{ optional($p->categories)->name ?? '-' }}</td>
                                    <td><strong>{{ $p->stock }}</strong></td>
                                    <td>
                                        @if($p->stock <= 0)
                                            <span class="badge badge-cancelled">Habis</span>
                                        @else
                                            <span class="badge badge-pending">Menipis</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                           href="{{ url('/product-list/edit-product-list/'.strtolower($p->code_product)) }}"
                                           aria-label="Tambah stok {{ $p->name }}">
                                            {{-- icon plus siluet --}}
                                            <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                            </svg>
                                            Tambah Stok
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Pesanan Terbaru --}}
    <div class="col-lg-4">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <div class="card-icon-box" style="background:rgba(37,99,235,.10);">
                    {{-- icon clock siluet --}}
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--blue);">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/>
                    </svg>
                </div>
                <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                <a href="{{ url('/order-list') }}" class="btn-text">Semua →</a>
            </div>
            <div class="card-body p-0">
                @if($recentOrders->isEmpty())
                    <div class="text-center py-5">
                        <svg width="36" height="36" fill="currentColor" viewBox="0 0 24 24"
                             style="color:var(--br-lt);opacity:.5;margin:0 auto 10px;">
                            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z" opacity=".3"/>
                            <path d="M3.5 5.5h17L18 2H6L3.5 5.5zM5 7v13h14V7H5z"/>
                        </svg>
                        <p class="mb-0 text-muted-brand" style="font-size:13px;">Belum ada pesanan.</p>
                    </div>
                @else
                    @php
                        $sLabel=['pending'=>'Menunggu','paid'=>'Dibayar','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Batal'];
                        $sCls  =['pending'=>'badge-pending','paid'=>'badge-paid','shipped'=>'badge-shipped','completed'=>'badge-completed','cancelled'=>'badge-cancelled'];
                    @endphp
                    <ul class="list-unstyled mb-0">
                        @foreach($recentOrders as $ro)
                        <li style="padding:11px 18px;">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <div class="overflow-hidden">
                                    <p class="mb-0 fw-600 text-truncate" style="font-size:13px;">
                                        #{{ $ro->id }} — {{ optional($ro->user)->first_name }} {{ optional($ro->user)->last_name }}
                                    </p>
                                    <p class="mb-0 text-muted-brand" style="font-size:11.5px;">
                                        Rp {{ number_format($ro->total_price,0,',','.') }}
                                        &bull; {{ $ro->created_at->format('d M H:i') }}
                                    </p>
                                </div>
                                <a href="{{ url('/order-list/'.$ro->id) }}"
                                   class="badge {{ $sCls[$ro->status] ?? 'badge-brand' }} status-badge"
                                   style="text-decoration:none;flex-shrink:0;"
                                   aria-label="Detail pesanan #{{ $ro->id }}">
                                    {{ $sLabel[$ro->status] ?? $ro->status }}
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ── ROW 3: Status Pesanan + Quick Access ── --}}
<div class="row g-3">

    {{-- Distribusi Status --}}
    <div class="col-lg-4">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <div class="card-icon-box" style="background:rgba(177,116,87,.10);">
                    {{-- icon chart siluet --}}
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                        <path d="M5 9.2h3V19H5V9.2zM10.6 5h2.8v14h-2.8V5zm5.6 8H19v6h-2.8v-6z"/>
                    </svg>
                </div>
                <h5 class="card-title mb-0">Status Pesanan</h5>
            </div>
            <div class="card-body">
                @php
                $statusMeta = [
                    'pending'  =>['label'=>'Menunggu Bayar','color'=>'var(--s-pending-tx)',  'bg'=>'var(--s-pending-bg)'],
                    'paid'     =>['label'=>'Sudah Dibayar', 'color'=>'var(--s-paid-tx)',     'bg'=>'var(--s-paid-bg)'],
                    'shipped'  =>['label'=>'Dikirim',       'color'=>'var(--s-shipped-tx)',  'bg'=>'var(--s-shipped-bg)'],
                    'completed'=>['label'=>'Selesai',       'color'=>'var(--s-completed-tx)','bg'=>'var(--s-completed-bg)'],
                    'cancelled'=>['label'=>'Dibatalkan',    'color'=>'var(--s-cancelled-tx)','bg'=>'var(--s-cancelled-bg)'],
                ];
                $grandTotal = max(array_sum($ordersByStatus),1);
                @endphp
                @foreach($statusMeta as $key => $meta)
                @php $count=$ordersByStatus[$key]??0; $pct=round($count/$grandTotal*100); @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span style="font-size:12.5px;font-weight:600;color:var(--tx-2);">{{ $meta['label'] }}</span>
                        <span style="font-size:12px;font-weight:700;color:{{ $meta['color'] }};">
                            {{ $count }} <span style="font-weight:400;color:var(--tx-4);">({{ $pct }}%)</span>
                        </span>
                    </div>
                    <div style="height:7px;border-radius:50px;background:var(--bd-lt);overflow:hidden;">
                        <div class="progress-bar-item" style="width:{{ $pct }}%;background:{{ $meta['color'] }};"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Quick Access — hover via CSS class, BUKAN onmouseover inline --}}
    <div class="col-lg-8">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <div class="card-icon-box" style="background:rgba(177,116,87,.10);">
                    {{-- icon lightning siluet --}}
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                        <path d="M7 2v11h3v9l7-12h-4l4-8z"/>
                    </svg>
                </div>
                <h5 class="card-title mb-0">Akses Cepat</h5>
            </div>
            <div class="card-body">
                @php
                $shortcuts = [
                    ['url'=>'/product-list',                  'label'=>'Data Produk',   'svg'=>'<path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>'],
                    ['url'=>'/product-list/add-product-list', 'label'=>'Tambah Produk', 'svg'=>'<path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>'],
                    ['url'=>'/categories',                    'label'=>'Kategori',      'svg'=>'<path d="M20 6H4l8-4 8 4zm-9 4v9H4v-9h7zm2 0h7v9h-7v-9z"/>'],
                    ['url'=>'/order-list',                    'label'=>'Pesanan',       'svg'=>'<path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z" opacity=".25"/><path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 5.5h17L18 2H6L3.5 5.5zM5 7v13h14V7H5zm3 3a4 4 0 008 0h-2a2 2 0 01-4 0H8z"/>'],
                    ['url'=>'/customer',                      'label'=>'Pelanggan',     'svg'=>'<path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>'],
                    ['url'=>'/gallery-company',               'label'=>'Galeri',        'svg'=>'<path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>'],
                    ['url'=>'/faq-company',                   'label'=>'FAQ',           'svg'=>'<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>'],
                    ['url'=>'/about-company',                 'label'=>'Perusahaan',    'svg'=>'<path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>'],
                ];
                @endphp
                <div class="row g-2">
                    @foreach($shortcuts as $sc)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <a href="{{ url($sc['url']) }}" class="quick-access-item" aria-label="{{ $sc['label'] }}">
                            <div class="qi-icon">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"
                                     style="color:var(--br);">{!! $sc['svg'] !!}</svg>
                            </div>
                            <span class="qi-label">{{ $sc['label'] }}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
