@extends('template.layout-admin')
@section('title_web', 'Dashboard | Hema.Indonesia')
@section('content-admin')

{{-- ════════════════════════════════════════════════════════
     STAT CARDS — data COUNT/SUM langsung dari database
════════════════════════════════════════════════════════ --}}
@php
    $stats = [
        [
            'icon'  => 'bi bi-box-seam-fill',
            'label' => 'Total Produk',
            'value' => number_format($totalProducts),
            'sub'   => $outOfStockCount . ' stok habis',
            'color' => '#b17457',
            'bg'    => 'rgba(177,116,87,.12)',
        ],
        [
            'icon'  => 'bi bi-bag-check-fill',
            'label' => 'Total Pesanan',
            'value' => number_format($totalOrders),
            'sub'   => ($orderGrowth >= 0 ? '▲' : '▼') . abs($orderGrowth) . '% vs bulan lalu',
            'color' => '#6366f1',
            'bg'    => 'rgba(99,102,241,.12)',
        ],
        [
            'icon'  => 'bi bi-people-fill',
            'label' => 'Pelanggan',
            'value' => number_format($totalCustomers),
            'sub'   => $ordersThisMonth . ' pesanan bulan ini',
            'color' => '#10b981',
            'bg'    => 'rgba(16,185,129,.12)',
        ],
        [
            'icon'  => 'bi bi-currency-dollar',
            'label' => 'Pendapatan',
            'value' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
            'sub'   => 'Bulan ini: Rp ' . number_format($revenueThisMonth, 0, ',', '.'),
            'color' => '#f59e0b',
            'bg'    => 'rgba(245,158,11,.12)',
        ],
    ];
@endphp

<div class="row g-3 mb-4">
    @foreach($stats as $s)
    <div class="col-xl-3 col-sm-6">
        <div class="card mb-0 border-0"
             style="border-left:4px solid {{ $s['color'] }} !important;border-radius:10px;">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center"
                     style="width:50px;height:50px;border-radius:12px;background:{{ $s['bg'] }};">
                    <i class="{{ $s['icon'] }}" style="color:{{ $s['color'] }};font-size:20px;"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="fw-800 mb-0 text-truncate"
                         style="color:{{ $s['color'] }};font-size:22px;line-height:1.1;">
                        {{ $s['value'] }}
                    </div>
                    <div class="text-muted-brand" style="font-size:12px;font-weight:600;">{{ $s['label'] }}</div>
                    <div style="font-size:11px;color:#a89080;margin-top:1px;">{{ $s['sub'] }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


{{-- ════════════════════════════════════════════════════════
     ROW 2: Stok Menipis + Pesanan Terbaru
════════════════════════════════════════════════════════ --}}
<div class="row g-3 mb-4">

    {{-- ── Stok Menipis / Habis ── --}}
    <div class="col-lg-8">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h5 class="card-title mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center justify-content-center"
                          style="width:32px;height:32px;background:rgba(239,68,68,.1);border-radius:8px;">
                        <i class="bi bi-exclamation-triangle-fill" style="color:#ef4444;font-size:14px;"></i>
                    </span>
                    Stok Menipis &amp; Habis
                </h5>
                <div class="d-flex gap-2 align-items-center">
                    <span class="badge bg-danger">{{ $outOfStockCount }} habis</span>
                    <span class="badge bg-warning text-dark">ambang &le; {{ $lowStockThreshold }}</span>
                    <a href="{{ url('/product-list') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body p-0">
                @if($lowStockProducts->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-check-circle-fill" style="font-size:2.5rem;color:#10b981;opacity:.4;"></i>
                        <p class="mt-2 mb-0 text-muted-brand" style="font-size:13.5px;">
                            Semua stok dalam kondisi aman.
                        </p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStockProducts as $p)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('uploads/products/'.$p->image) }}"
                                                 style="width:36px;height:36px;object-fit:cover;border-radius:6px;border:1px solid #ede3db;"
                                                 alt="">
                                            <span class="fw-600" style="font-size:13.5px;">{{ $p->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-muted-brand">{{ optional($p->categories)->name ?? '-' }}</td>
                                    <td><strong>{{ $p->stock }}</strong></td>
                                    <td>
                                        @if($p->stock <= 0)
                                            <span class="badge bg-danger">Habis</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Menipis</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                           href="{{ url('/product-list/edit-product-list/'.strtolower($p->code_product)) }}">
                                            <i class="bi bi-plus-lg"></i> Tambah Stok
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

    {{-- ── Pesanan Terbaru ── --}}
    <div class="col-lg-4">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h5 class="card-title mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center justify-content-center"
                          style="width:32px;height:32px;background:rgba(99,102,241,.1);border-radius:8px;">
                        <i class="bi bi-clock-history" style="color:#6366f1;font-size:14px;"></i>
                    </span>
                    Pesanan Terbaru
                </h5>
                <a href="{{ url('/order-list') }}" class="btn btn-sm btn-secondary">Semua</a>
            </div>
            <div class="card-body p-0">
                @if($recentOrders->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-bag-x" style="font-size:2.2rem;color:#d4a882;opacity:.5;"></i>
                        <p class="mt-2 mb-0 text-muted-brand" style="font-size:13px;">Belum ada pesanan.</p>
                    </div>
                @else
                    @php
                        $sColor = [
                            'pending'   => '#f59e0b',
                            'paid'      => '#6366f1',
                            'shipped'   => '#8b5cf6',
                            'completed' => '#10b981',
                            'cancelled' => '#ef4444',
                        ];
                        $sLabel = [
                            'pending'   => 'Menunggu',
                            'paid'      => 'Dibayar',
                            'shipped'   => 'Dikirim',
                            'completed' => 'Selesai',
                            'cancelled' => 'Batal',
                        ];
                    @endphp
                    <ul class="list-unstyled mb-0">
                        @foreach($recentOrders as $ro)
                        <li style="padding:11px 18px;border-bottom:1px solid #f5ede6;">
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <div class="overflow-hidden">
                                    <p class="mb-0 fw-600 text-truncate" style="font-size:13px;">
                                        #{{ $ro->id }} — {{ optional($ro->user)->first_name }} {{ optional($ro->user)->last_name }}
                                    </p>
                                    <p class="mb-0 text-muted-brand" style="font-size:11.5px;">
                                        Rp {{ number_format($ro->total_price, 0, ',', '.') }}
                                        &bull; {{ $ro->created_at->format('d M H:i') }}
                                    </p>
                                </div>
                                <a href="{{ url('/order-list/'.$ro->id) }}"
                                   style="flex-shrink:0;font-size:10.5px;font-weight:700;
                                          padding:3px 9px;border-radius:50px;text-decoration:none;
                                          background:{{ ($sColor[$ro->status] ?? '#6b7280') }}1a;
                                          color:{{ $sColor[$ro->status] ?? '#6b7280' }};">
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


{{-- ════════════════════════════════════════════════════════
     ROW 3: Distribusi Status Pesanan + Quick Access
════════════════════════════════════════════════════════ --}}
<div class="row g-3">

    {{-- ── Distribusi Status ── --}}
    <div class="col-lg-4">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h5 class="card-title mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center justify-content-center"
                          style="width:32px;height:32px;background:rgba(177,116,87,.1);border-radius:8px;">
                        <i class="bi bi-pie-chart-fill" style="color:#b17457;font-size:14px;"></i>
                    </span>
                    Status Pesanan
                </h5>
            </div>
            <div class="card-body">
                @php
                    $statusMeta = [
                        'pending'   => ['label'=>'Menunggu Bayar', 'color'=>'#f59e0b', 'bg'=>'rgba(245,158,11,.12)'],
                        'paid'      => ['label'=>'Sudah Dibayar',  'color'=>'#6366f1', 'bg'=>'rgba(99,102,241,.12)'],
                        'shipped'   => ['label'=>'Dikirim',        'color'=>'#8b5cf6', 'bg'=>'rgba(139,92,246,.12)'],
                        'completed' => ['label'=>'Selesai',        'color'=>'#10b981', 'bg'=>'rgba(16,185,129,.12)'],
                        'cancelled' => ['label'=>'Dibatalkan',     'color'=>'#ef4444', 'bg'=>'rgba(239,68,68,.12)'],
                    ];
                    $grandTotal = max(array_sum($ordersByStatus), 1);
                @endphp
                @foreach($statusMeta as $key => $meta)
                @php $count = $ordersByStatus[$key] ?? 0; $pct = round($count / $grandTotal * 100); @endphp
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span style="font-size:12.5px;font-weight:600;color:#3d2e26;">{{ $meta['label'] }}</span>
                        <span style="font-size:12px;font-weight:700;color:{{ $meta['color'] }};">
                            {{ $count }} <span style="font-weight:400;color:#a89080;">({{ $pct }}%)</span>
                        </span>
                    </div>
                    <div style="height:7px;border-radius:50px;background:#f0ece8;overflow:hidden;">
                        <div style="height:100%;width:{{ $pct }}%;background:{{ $meta['color'] }};border-radius:50px;
                                    transition:width .5s ease;"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Quick Access ── --}}
    <div class="col-lg-8">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h5 class="card-title mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center justify-content-center"
                          style="width:32px;height:32px;background:rgba(177,116,87,.1);border-radius:8px;">
                        <i class="bi bi-lightning-fill" style="color:#b17457;font-size:14px;"></i>
                    </span>
                    Akses Cepat
                </h5>
            </div>
            <div class="card-body">
                @php
                    $shortcuts = [
                        ['url'=>'/product-list',                 'icon'=>'bi bi-box-seam',        'label'=>'Data Produk',    'color'=>'#b17457','bg'=>'rgba(177,116,87,.1)'],
                        ['url'=>'/product-list/add-product-list','icon'=>'bi bi-plus-circle',      'label'=>'Tambah Produk',  'color'=>'#10b981','bg'=>'rgba(16,185,129,.1)'],
                        ['url'=>'/categories',                   'icon'=>'bi bi-tags',             'label'=>'Kategori',       'color'=>'#f59e0b','bg'=>'rgba(245,158,11,.1)'],
                        ['url'=>'/order-list',                   'icon'=>'bi bi-bag-check',        'label'=>'Pesanan',        'color'=>'#6366f1','bg'=>'rgba(99,102,241,.1)'],
                        ['url'=>'/customer',                     'icon'=>'bi bi-people',           'label'=>'Pelanggan',      'color'=>'#ec4899','bg'=>'rgba(236,72,153,.1)'],
                        ['url'=>'/gallery-company',              'icon'=>'bi bi-images',           'label'=>'Galeri',         'color'=>'#14b8a6','bg'=>'rgba(20,184,166,.1)'],
                        ['url'=>'/faq-company',                  'icon'=>'bi bi-question-circle',  'label'=>'FAQ',            'color'=>'#8b5cf6','bg'=>'rgba(139,92,246,.1)'],
                        ['url'=>'/about-company',                'icon'=>'bi bi-building',         'label'=>'Perusahaan',     'color'=>'#0ea5e9','bg'=>'rgba(14,165,233,.1)'],
                    ];
                @endphp
                <div class="row g-2">
                    @foreach($shortcuts as $sc)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <a href="{{ url($sc['url']) }}"
                           class="d-flex align-items-center gap-2 p-3 rounded text-decoration-none"
                           style="background:#faf8f6;border:1px solid #ede3db;transition:all .2s;"
                           onmouseover="this.style.borderColor='{{ $sc['color'] }}';this.style.background='{{ $sc['bg'] }}';this.style.transform='translateY(-1px)';"
                           onmouseout="this.style.borderColor='#ede3db';this.style.background='#faf8f6';this.style.transform='';">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center"
                                 style="width:36px;height:36px;border-radius:9px;background:{{ $sc['bg'] }};">
                                <i class="{{ $sc['icon'] }}" style="color:{{ $sc['color'] }};font-size:16px;"></i>
                            </div>
                            <span style="font-weight:600;font-size:12.5px;color:#1e1410;line-height:1.2;">{{ $sc['label'] }}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>{{-- /row 3 --}}

@endsection
