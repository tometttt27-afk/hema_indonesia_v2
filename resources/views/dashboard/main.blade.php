@extends('template.layout-admin')
@section('title_web', 'Dashboard | Hema.Indonesia')
@section('content-admin')

    {{-- ── Stat Cards ── --}}
    <div class="row g-3 mb-4">
        @php
            $stats = [
                ['icon' => 'fas fa-boxes-stacked', 'label' => 'Total Produk',  'value' => $totalProducts ?? 0,       'color' => '#b17457'],
                ['icon' => 'fas fa-shopping-bag',  'label' => 'Pesanan Masuk', 'value' => $totalOrders ?? 0,         'color' => '#c29470'],
                ['icon' => 'fas fa-users',          'label' => 'Pelanggan',     'value' => $totalCustomers ?? 0,      'color' => '#9a6040'],
                ['icon' => 'fas fa-triangle-exclamation', 'label' => 'Stok Habis', 'value' => $outOfStockCount ?? 0, 'color' => '#dc3545'],
            ];
        @endphp
        @foreach ($stats as $s)
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card h-100 mb-0" style="border-left: 4px solid {{ $s['color'] }} !important;">
                    <div class="card-body d-flex align-items-center gap-3 py-3">
                        <div style="width:46px;height:46px;border-radius:50%;background:{{ $s['color'] }}22;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="{{ $s['icon'] }}" style="color:{{ $s['color'] }};font-size:18px;"></i>
                        </div>
                        <div>
                            <p class="mb-0" style="font-size:22px;font-weight:700;color:{{ $s['color'] }};line-height:1.2;">{{ $s['value'] }}</p>
                            <p class="mb-0" style="font-size:12px;color:#7a6255;">{{ $s['label'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ── Stok Menipis & Habis ── --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-triangle-exclamation me-2" style="color:#b17457;"></i>Stok Menipis &amp; Habis
                    </h5>
                    <div class="d-flex gap-2">
                        <span class="badge bg-danger">{{ $outOfStockCount ?? 0 }} habis</span>
                        <span class="badge bg-warning text-dark">ambang &le; {{ $lowStockThreshold ?? 5 }}</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if (empty($lowStockProducts) || $lowStockProducts->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-circle-check fa-2x mb-2" style="color:#b17457;opacity:.5;"></i>
                            <p class="mb-0">Semua stok produk dalam kondisi aman.</p>
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
                                    @foreach ($lowStockProducts as $p)
                                        <tr>
                                            <td class="fw-500">{{ $p->name }}</td>
                                            <td>{{ optional($p->categories)->name }}</td>
                                            <td><strong>{{ $p->stock }}</strong></td>
                                            <td>
                                                @if ($p->stock <= 0)
                                                    <span class="badge bg-danger">Habis</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Menipis</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ url('/product-list/edit-product-list/' . strtolower($p->code_product)) }}">
                                                    <i class="bi bi-plus-lg me-1"></i>Tambah Stok
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
    </div>

    {{-- ── Shortcut Menu ── --}}
    <div class="row g-3">
        @php
            $shortcuts = [
                ['url' => '/product-list',   'icon' => 'fas fa-shirt',        'label' => 'Data Produk'],
                ['url' => '/categories',     'icon' => 'fas fa-tags',          'label' => 'Kategori'],
                ['url' => '/order-list',     'icon' => 'fas fa-shopping-bag',  'label' => 'Pesanan'],
                ['url' => '/customer',       'icon' => 'fas fa-users',          'label' => 'Pelanggan'],
                ['url' => '/gallery-company','icon' => 'fas fa-images',         'label' => 'Galeri'],
                ['url' => '/faq-company',    'icon' => 'fas fa-circle-question','label' => 'FAQ'],
                ['url' => '/about-company',  'icon' => 'fas fa-building',       'label' => 'Perusahaan'],
                ['url' => '/profile',        'icon' => 'fas fa-user-circle',    'label' => 'Profil Saya'],
            ];
        @endphp
        @foreach ($shortcuts as $sc)
            <div class="col-lg-3 col-sm-6 col-6">
                <a href="{{ url($sc['url']) }}" class="card text-center text-decoration-none h-100 mb-0"
                    style="transition:box-shadow .2s,transform .2s;">
                    <div class="card-body py-4">
                        <i class="{{ $sc['icon'] }} fa-2x mb-2" style="color:#b17457;"></i>
                        <p class="mb-0 fw-600" style="font-size:13px;color:#2c1f17;">{{ $sc['label'] }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <style>
        .card:hover { box-shadow: 0 6px 20px rgba(177,116,87,.18) !important; transform: translateY(-2px); }
        .fw-500 { font-weight: 500; }
        .fw-600 { font-weight: 600; }
    </style>
@endsection
