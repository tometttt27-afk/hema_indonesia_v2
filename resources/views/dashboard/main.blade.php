@extends('template.layout-admin')
@section('title_web', 'Dashboard | Hema.Indonesia')
@section('content-admin')

{{-- ── STAT CARDS ── --}}
<div class="row g-3 mb-4">
    @php
        $stats = [
            ['icon'=>'bi bi-box-seam-fill',       'label'=>'Total Produk',   'value'=>$totalProducts??0,   'color'=>'#b17457','bg'=>'rgba(177,116,87,.12)'],
            ['icon'=>'bi bi-bag-check-fill',       'label'=>'Pesanan Masuk', 'value'=>$totalOrders??0,     'color'=>'#6366f1','bg'=>'rgba(99,102,241,.12)'],
            ['icon'=>'bi bi-people-fill',          'label'=>'Pelanggan',     'value'=>$totalCustomers??0,  'color'=>'#10b981','bg'=>'rgba(16,185,129,.12)'],
            ['icon'=>'bi bi-exclamation-triangle-fill','label'=>'Stok Habis','value'=>$outOfStockCount??0,'color'=>'#ef4444','bg'=>'rgba(239,68,68,.12)'],
        ];
    @endphp
    @foreach($stats as $s)
    <div class="col-xl-3 col-sm-6">
        <div class="card stat-card mb-0 border-0" style="border-left:4px solid {{ $s['color'] }} !important;border-radius:10px;">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="stat-icon flex-shrink-0" style="background:{{ $s['bg'] }};width:50px;height:50px;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                    <i class="{{ $s['icon'] }}" style="color:{{ $s['color'] }};font-size:20px;"></i>
                </div>
                <div>
                    <div class="stat-value fw-800 mb-0" style="color:{{ $s['color'] }};font-size:26px;line-height:1;">{{ number_format($s['value']) }}</div>
                    <div class="stat-label" style="font-size:12px;color:#7a6255;margin-top:3px;">{{ $s['label'] }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-3 mb-4">
    {{-- ── STOK MENIPIS ── --}}
    <div class="col-lg-8">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h5 class="card-title mb-0 d-flex align-items-center gap-2">
                    <span style="width:32px;height:32px;background:rgba(239,68,68,.1);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                        <i class="bi bi-exclamation-triangle-fill" style="color:#ef4444;font-size:14px;"></i>
                    </span>
                    Stok Menipis &amp; Habis
                </h5>
                <div class="d-flex gap-2">
                    <span class="badge bg-danger">{{ $outOfStockCount??0 }} habis</span>
                    <span class="badge bg-warning text-dark">ambang &le; {{ $lowStockThreshold??5 }}</span>
                </div>
            </div>
            <div class="card-body p-0">
                @if(empty($lowStockProducts)||$lowStockProducts->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-check-circle-fill" style="font-size:2.5rem;color:#10b981;opacity:.45;"></i>
                        <p class="mt-2 mb-0" style="color:#7a6255;font-size:13.5px;">Semua stok produk dalam kondisi aman.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead><tr>
                                <th>Produk</th><th>Kategori</th><th>Stok</th><th>Status</th><th>Aksi</th>
                            </tr></thead>
                            <tbody>
                                @foreach($lowStockProducts as $p)
                                <tr>
                                    <td class="fw-600">{{ $p->name }}</td>
                                    <td>{{ optional($p->categories)->name }}</td>
                                    <td><strong>{{ $p->stock }}</strong></td>
                                    <td>
                                        @if($p->stock<=0)
                                            <span class="badge bg-danger">Habis</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Menipis</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ url('/product-list/edit-product-list/'.strtolower($p->code_product)) }}">
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

    {{-- ── AKTIVITAS TERBARU ── --}}
    <div class="col-lg-4">
        <div class="card h-100 mb-0">
            <div class="card-header">
                <h5 class="card-title mb-0 d-flex align-items-center gap-2">
                    <span style="width:32px;height:32px;background:rgba(99,102,241,.1);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                        <i class="bi bi-clock-history" style="color:#6366f1;font-size:14px;"></i>
                    </span>
                    Pesanan Terbaru
                </h5>
                <a href="{{ url('/order-list') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @php $recentOrders = $recentOrders ?? collect([]); @endphp
                @if($recentOrders->isEmpty())
                    <div class="text-center py-5">
                        <i class="bi bi-bag-x" style="font-size:2.2rem;color:#d4a882;opacity:.5;"></i>
                        <p class="mt-2 mb-0" style="color:#7a6255;font-size:13px;">Belum ada pesanan.</p>
                    </div>
                @else
                    <ul class="list-unstyled mb-0">
                        @foreach($recentOrders->take(6) as $ro)
                        @php
                            $sColor=['pending'=>'#f59e0b','paid'=>'#6366f1','shipped'=>'#8b5cf6','completed'=>'#10b981','cancelled'=>'#ef4444'];
                            $sLabel=['pending'=>'Menunggu','paid'=>'Dibayar','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Batal'];
                        @endphp
                        <li style="padding:10px 18px;border-bottom:1px solid #f5ede6;">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="mb-0 fw-600" style="font-size:13px;">#{{ $ro->id }} — {{ optional($ro->user)->first_name }}</p>
                                    <p class="mb-0" style="font-size:11.5px;color:#7a6255;">Rp. {{ number_format($ro->total_price,0,',','.') }}</p>
                                </div>
                                <span style="font-size:10.5px;font-weight:700;padding:3px 9px;border-radius:50px;background:{{ $sColor[$ro->status]??'#6b7280' }}1a;color:{{ $sColor[$ro->status]??'#6b7280' }};">
                                    {{ $sLabel[$ro->status]??$ro->status }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ── QUICK ACCESS ── --}}
<div class="card mb-0">
    <div class="card-header">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2">
            <span style="width:32px;height:32px;background:rgba(177,116,87,.1);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;">
                <i class="bi bi-lightning-fill" style="color:#b17457;font-size:14px;"></i>
            </span>
            Akses Cepat
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @php
                $shortcuts = [
                    ['url'=>'/product-list',           'icon'=>'bi bi-box-seam',         'label'=>'Data Produk',   'color'=>'#b17457','bg'=>'rgba(177,116,87,.1)'],
                    ['url'=>'/product-list/add-product-list','icon'=>'bi bi-plus-circle', 'label'=>'Tambah Produk','color'=>'#10b981','bg'=>'rgba(16,185,129,.1)'],
                    ['url'=>'/categories',             'icon'=>'bi bi-tags',              'label'=>'Kategori',      'color'=>'#f59e0b','bg'=>'rgba(245,158,11,.1)'],
                    ['url'=>'/order-list',             'icon'=>'bi bi-bag-check',         'label'=>'Pesanan',       'color'=>'#6366f1','bg'=>'rgba(99,102,241,.1)'],
                    ['url'=>'/customer',               'icon'=>'bi bi-people',            'label'=>'Pelanggan',     'color'=>'#ec4899','bg'=>'rgba(236,72,153,.1)'],
                    ['url'=>'/gallery-company',        'icon'=>'bi bi-images',            'label'=>'Galeri',        'color'=>'#14b8a6','bg'=>'rgba(20,184,166,.1)'],
                    ['url'=>'/faq-company',            'icon'=>'bi bi-question-circle',   'label'=>'FAQ',           'color'=>'#8b5cf6','bg'=>'rgba(139,92,246,.1)'],
                    ['url'=>'/about-company',          'icon'=>'bi bi-building',          'label'=>'Perusahaan',    'color'=>'#0ea5e9','bg'=>'rgba(14,165,233,.1)'],
                ];
            @endphp
            @foreach($shortcuts as $sc)
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <a href="{{ url($sc['url']) }}"
                   class="d-flex align-items-center gap-3 p-3 rounded text-decoration-none"
                   style="background:#faf8f6;border:1px solid #ede3db;transition:all .2s;"
                   onmouseover="this.style.borderColor='{{ $sc['color'] }}';this.style.boxShadow='0 4px 14px {{ $sc['color'] }}22';"
                   onmouseout="this.style.borderColor='#ede3db';this.style.boxShadow='none';">
                    <div style="width:40px;height:40px;border-radius:10px;background:{{ $sc['bg'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="{{ $sc['icon'] }}" style="color:{{ $sc['color'] }};font-size:18px;"></i>
                    </div>
                    <span style="font-weight:600;font-size:13.5px;color:#1e1410;">{{ $sc['label'] }}</span>
                    <i class="bi bi-chevron-right ms-auto" style="color:#a89080;font-size:11px;"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
