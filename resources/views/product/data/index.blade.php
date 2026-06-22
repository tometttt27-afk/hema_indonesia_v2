@extends('template.layout-admin')
@section('title_web', 'Data Produk | Hema.Indonesia')
@section('content-admin')

{{-- ── Page Header ── --}}
<div class="page-header">
    <div class="page-title">
        <h4>Data Produk</h4>
        <h6>Diurutkan terbaru · Produk aktif langsung tampil di katalog customer</h6>
    </div>
    <a href="{{ url('/product-list/add-product-list') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

{{-- ── Stats strip ── --}}
@php
    $total      = $data->count();
    $active     = $data->where('is_active', 1)->count();
    $inactive   = $data->where('is_active', 0)->count();
    $outOfStock = $data->filter(fn($p) => !is_null($p->stock) && $p->stock <= 0)->count();
    $lowStock   = $data->filter(fn($p) => !is_null($p->stock) && $p->stock > 0 && $p->stock <= 5)->count();
@endphp

<div class="row g-3 mb-4">
    @foreach([
        ['label'=>'Total Produk', 'value'=>$total,      'color'=>'#b17457', 'bg'=>'rgba(177,116,87,.10)', 'icon'=>'bi bi-box-seam-fill'],
        ['label'=>'Aktif',        'value'=>$active,     'color'=>'#16a34a', 'bg'=>'rgba(22,163,74,.10)',  'icon'=>'bi bi-check-circle-fill'],
        ['label'=>'Tidak Aktif',  'value'=>$inactive,   'color'=>'#6b7280', 'bg'=>'rgba(107,114,128,.10)','icon'=>'bi bi-slash-circle-fill'],
        ['label'=>'Stok Habis',   'value'=>$outOfStock, 'color'=>'#dc2626', 'bg'=>'rgba(220,38,38,.10)',  'icon'=>'bi bi-exclamation-triangle-fill'],
        ['label'=>'Stok Menipis', 'value'=>$lowStock,   'color'=>'#d97706', 'bg'=>'rgba(217,119,6,.10)',  'icon'=>'bi bi-exclamation-circle-fill'],
    ] as $s)
    <div class="col">
        <div class="card mb-0 border-0 h-100"
             style="border-left:3px solid {{ $s['color'] }} !important;border-radius:8px;">
            <div class="card-body d-flex align-items-center gap-2 py-3 px-3">
                <div style="width:36px;height:36px;border-radius:9px;
                            background:{{ $s['bg'] }};flex-shrink:0;
                            display:flex;align-items:center;justify-content:center;">
                    <i class="{{ $s['icon'] }}" style="color:{{ $s['color'] }};font-size:15px;"></i>
                </div>
                <div>
                    <div style="font-size:20px;font-weight:800;color:{{ $s['color'] }};line-height:1.1;">
                        {{ $s['value'] }}
                    </div>
                    <div style="font-size:11px;color:#7a6255;font-weight:600;">{{ $s['label'] }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- ── Data Table ── --}}
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2">
            <i class="bi bi-table" style="color:#b17457;"></i>
            Daftar Produk
        </h5>
        <span class="badge badge-brand">{{ $total }} produk</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0" id="product-table">
                <thead>
                    <tr>
                        <th style="width:72px;">Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Ukuran</th>
                        <th>Status</th>
                        <th style="width:110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $product)
                    @php
                        $isOut  = !is_null($product->stock) && $product->stock <= 0;
                        $isLow  = !is_null($product->stock) && $product->stock > 0 && $product->stock <= 5;
                        $isNew  = $product->created_at && $product->created_at->diffInHours(now()) <= 24;
                    @endphp
                    <tr class="{{ $isOut ? 'table-row-danger' : ($isLow ? 'table-row-warning' : '') }}">

                        {{-- Foto — klik untuk lightbox --}}
                        <td>
                            <a href="{{ asset('uploads/products/'.$product->image) }}"
                               class="image-popup d-block"
                               style="width:60px;height:60px;border-radius:8px;overflow:hidden;
                                      border:1.5px solid #ede3db;display:block;">
                                <img src="{{ asset('uploads/products/'.$product->image) }}"
                                     alt="{{ $product->name }}"
                                     style="width:60px;height:60px;object-fit:cover;
                                            transition:transform .25s ease;"
                                     onmouseover="this.style.transform='scale(1.08)'"
                                     onmouseout="this.style.transform='scale(1)'">
                            </a>
                        </td>

                        {{-- Nama --}}
                        <td>
                            <div class="d-flex align-items-start gap-1 flex-column">
                                <span class="fw-600" style="font-size:13.5px;">{{ $product->name }}</span>
                                <div class="d-flex align-items-center gap-1 flex-wrap">
                                    <code style="font-size:10.5px;background:#f5f3f0;
                                                 padding:1px 6px;border-radius:4px;color:#7a6255;">
                                        {{ $product->code_product }}
                                    </code>
                                    @if($isNew)
                                    <span class="badge"
                                          style="background:#dcfce7;color:#14532d;
                                                 font-size:9.5px;padding:2px 7px;">
                                        BARU
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        {{-- Kategori --}}
                        <td>
                            <span class="badge badge-brand">
                                {{ optional($product->categories)->name ?? '—' }}
                            </span>
                        </td>

                        {{-- Stok --}}
                        <td>
                            @if(is_null($product->stock))
                                <span style="font-size:18px;color:#10b981;" title="Stok tidak terbatas">&infin;</span>
                            @elseif($isOut)
                                <span class="badge bg-danger">Habis</span>
                            @elseif($isLow)
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $product->stock }}
                                </span>
                            @else
                                <span class="badge bg-success">{{ number_format($product->stock) }}</span>
                            @endif
                        </td>

                        {{-- Harga --}}
                        <td>
                            @if($product->discount > 0)
                                <div style="font-size:11.5px;color:#a89080;text-decoration:line-through;">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                <div class="d-flex align-items-center gap-1 flex-wrap mt-0.5">
                                    <span class="badge bg-warning text-dark" style="font-size:10px;">
                                        -{{ $product->discount }}%
                                    </span>
                                    <strong style="color:#b17457;font-size:13px;">
                                        Rp {{ number_format($product->final_price, 0, ',', '.') }}
                                    </strong>
                                </div>
                            @else
                                <strong style="font-size:13.5px;">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </strong>
                            @endif
                        </td>

                        {{-- Ukuran --}}
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($product->sizes_array as $sz)
                                    <span style="font-size:10px;font-weight:700;
                                                 text-transform:uppercase;
                                                 background:#f5f3f0;
                                                 border:1px solid #e8ddd7;
                                                 padding:1px 6px;border-radius:4px;
                                                 color:#3d2e26;">
                                        {{ $sz }}
                                    </span>
                                @endforeach
                            </div>
                        </td>

                        {{-- Status toggle --}}
                        <td>
                            <form action="{{ route('productsListStatusPut', $product->code_product) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="button" class="confirm-status"
                                        style="background:transparent;border:none;padding:0;"
                                        title="{{ $product->is_active ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}">
                                    <div class="is_active-toggle d-flex align-items-center">
                                        <input type="checkbox"
                                               id="tog_{{ $product->code_product }}"
                                               class="check" name="is_active" value="1"
                                               {{ $product->is_active ? 'checked' : '' }}>
                                        <label for="tog_{{ $product->code_product }}"
                                               class="checktoggle">checkbox</label>
                                    </div>
                                </button>
                            </form>
                            <div style="font-size:10px;margin-top:3px;
                                        color:{{ $product->is_active ? '#16a34a' : '#6b7280' }};
                                        font-weight:600;">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </div>
                        </td>

                        {{-- Aksi --}}
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ url('/product-list/edit-product-list/'.strtolower($product->code_product)) }}"
                                   class="btn btn-sm btn-secondary" title="Edit produk">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- Tombol hapus → trigger SweetAlert konfirmasi --}}
                                <button type="button"
                                        class="btn btn-sm btn-soft-danger btn-delete"
                                        data-form="form-del-prod-{{ $product->code_product }}"
                                        data-name="{{ $product->name }}"
                                        data-type="Produk"
                                        title="Hapus produk">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <form id="form-del-prod-{{ $product->code_product }}"
                                      action="{{ route('productsListDelete', strtolower($product->code_product)) }}"
                                      method="POST" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-box-seam"
                               style="font-size:2.5rem;color:#d4a882;opacity:.4;display:block;margin-bottom:10px;"></i>
                            <p class="mb-3" style="color:#7a6255;">Belum ada produk tersimpan.</p>
                            <a href="{{ url('/product-list/add-product-list') }}"
                               class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg"></i> Tambah Produk Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ── Row highlight styles ── --}}
<style>
.table-row-danger  > td:first-child { border-left: 3px solid #dc2626 !important; }
.table-row-warning > td:first-child { border-left: 3px solid #d97706 !important; }
</style>

@endsection
