@extends('template.layout-admin')
@section('title_web', 'Dashboard | Hema.Indonesia')
@section('content-admin')

    {{-- ═══════════════════════════════════════════
         STAT CARDS
         Warna aksen per-tile di-set via CSS var custom
         agar bisa berjalan tanpa inline style.
    ════════════════════════════════════════════ --}}
    <div class="row g-3 mb-4">
        @php
            $stats = [
                [
                    'icon'     => 'fas fa-boxes-stacked',
                    'label'    => 'Total Produk',
                    'value'    => $totalProducts   ?? 0,
                    'color'    => '#b17457',
                    'bg'       => 'rgba(177,116,87,0.13)',
                ],
                [
                    'icon'     => 'fas fa-shopping-bag',
                    'label'    => 'Pesanan Masuk',
                    'value'    => $totalOrders     ?? 0,
                    'color'    => '#c29470',
                    'bg'       => 'rgba(194,148,112,0.13)',
                ],
                [
                    'icon'     => 'fas fa-users',
                    'label'    => 'Pelanggan',
                    'value'    => $totalCustomers  ?? 0,
                    'color'    => '#9a6040',
                    'bg'       => 'rgba(154,96,64,0.13)',
                ],
                [
                    'icon'     => 'fas fa-triangle-exclamation',
                    'label'    => 'Stok Habis',
                    'value'    => $outOfStockCount ?? 0,
                    'color'    => '#dc3545',
                    'bg'       => 'rgba(220,53,69,0.13)',
                ],
            ];
        @endphp

        @foreach ($stats as $s)
            <div class="col-lg-3 col-sm-6 col-12">
                {{-- border-left warna accent diset inline karena beda tiap tile --}}
                <div class="card stat-card h-100 mb-0"
                     style="border-left-color: {{ $s['color'] }} !important;">
                    <div class="card-body d-flex align-items-center gap-3 py-3">
                        <div class="stat-icon"
                             style="background: {{ $s['bg'] }};">
                            <i class="{{ $s['icon'] }}"
                               style="color: {{ $s['color'] }}; font-size: 18px;"></i>
                        </div>
                        <div>
                            <p class="stat-value mb-0"
                               style="color: {{ $s['color'] }};">{{ $s['value'] }}</p>
                            <p class="stat-label">{{ $s['label'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    {{-- ═══════════════════════════════════════════
         STOK MENIPIS & HABIS
    ════════════════════════════════════════════ --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-triangle-exclamation me-2 card-header-icon"></i>
                        Stok Menipis &amp; Habis
                    </h5>
                    <div class="d-flex gap-2">
                        <span class="badge bg-danger">{{ $outOfStockCount ?? 0 }} habis</span>
                        <span class="badge bg-warning text-dark">
                            ambang &le; {{ $lowStockThreshold ?? 5 }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if (empty($lowStockProducts) || $lowStockProducts->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-circle-check fa-2x mb-2 stock-safe-icon"></i>
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


    {{-- ═══════════════════════════════════════════
         SHORTCUT MENU
    ════════════════════════════════════════════ --}}
    <div class="row g-3">
        @php
            $shortcuts = [
                ['url' => '/product-list',    'icon' => 'fas fa-shirt',         'label' => 'Data Produk'],
                ['url' => '/categories',      'icon' => 'fas fa-tags',           'label' => 'Kategori'],
                ['url' => '/order-list',      'icon' => 'fas fa-shopping-bag',   'label' => 'Pesanan'],
                ['url' => '/customer',        'icon' => 'fas fa-users',          'label' => 'Pelanggan'],
                ['url' => '/gallery-company', 'icon' => 'fas fa-images',         'label' => 'Galeri'],
                ['url' => '/faq-company',     'icon' => 'fas fa-circle-question','label' => 'FAQ'],
                ['url' => '/about-company',   'icon' => 'fas fa-building',       'label' => 'Perusahaan'],
                ['url' => '/profile',         'icon' => 'fas fa-user-circle',    'label' => 'Profil Saya'],
            ];
        @endphp

        @foreach ($shortcuts as $sc)
            <div class="col-lg-3 col-sm-6 col-6">
                <a href="{{ url($sc['url']) }}" class="card shortcut-card h-100 mb-0">
                    <div class="card-body py-4">
                        <i class="{{ $sc['icon'] }} shortcut-icon"></i>
                        <p class="shortcut-label">{{ $sc['label'] }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection
