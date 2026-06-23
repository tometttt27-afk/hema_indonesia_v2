@extends('template.layout-admin')
@section('title_web', 'Data Produk | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Data Produk</h4>
        <h6>Diurutkan terbaru · Produk aktif langsung tampil di katalog customer</h6>
    </div>
    <a href="{{ url('/product-list/add-product-list') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
        Tambah Produk
    </a>
</div>

{{-- Stats strip --}}
@php
    $total      = $data->count();
    $active     = $data->where('is_active',1)->count();
    $inactive   = $data->where('is_active',0)->count();
    $outOfStock = $data->filter(fn($p)=>!is_null($p->stock)&&$p->stock<=0)->count();
    $lowStock   = $data->filter(fn($p)=>!is_null($p->stock)&&$p->stock>0&&$p->stock<=5)->count();
    $statsStrip = [
        ['label'=>'Total Produk', 'value'=>$total,      'card'=>'stat-card-brand', 'icon_bg'=>'stat-icon-brand', 'color'=>'var(--br)',    'svg'=>'<path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>'],
        ['label'=>'Aktif',        'value'=>$active,     'card'=>'stat-card-green', 'icon_bg'=>'stat-icon-green', 'color'=>'var(--green)', 'svg'=>'<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>'],
        ['label'=>'Tidak Aktif',  'value'=>$inactive,   'card'=>'',               'icon_bg'=>'',               'color'=>'#6b7280',      'svg'=>'<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/>'],
        ['label'=>'Stok Habis',   'value'=>$outOfStock, 'card'=>'stat-card-red',   'icon_bg'=>'stat-icon-red',   'color'=>'var(--red)',   'svg'=>'<path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>'],
        ['label'=>'Stok Menipis', 'value'=>$lowStock,   'card'=>'stat-card-amber', 'icon_bg'=>'stat-icon-amber', 'color'=>'var(--amber)', 'svg'=>'<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>'],
    ];
@endphp

<div class="row g-3 mb-4">
    @foreach($statsStrip as $s)
    <div class="col">
        <div class="card mb-0 border-0 h-100 {{ $s['card'] }}">
            <div class="card-body d-flex align-items-center gap-2 py-3 px-3">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center {{ $s['icon_bg'] }}"
                     style="width:36px;height:36px;border-radius:9px;">
                    <svg width="17" height="17" fill="currentColor" viewBox="0 0 24 24"
                         style="color:{{ $s['color'] }};">{!! $s['svg'] !!}</svg>
                </div>
                <div>
                    <div style="font-size:20px;font-weight:800;color:{{ $s['color'] }};line-height:1.1;">{{ $s['value'] }}</div>
                    <div style="font-size:11px;color:var(--tx-3);font-weight:600;">{{ $s['label'] }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Data Table --}}
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                <path d="M3 3h18v2H3V3zm0 4h18v2H3V7zm0 4h18v2H3v-2zm0 4h18v2H3v-2zm0 4h18v2H3v-2z"/>
            </svg>
            <h5 class="card-title mb-0">Daftar Produk</h5>
        </div>
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
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $product)
                    @php
                        $isOut = !is_null($product->stock) && $product->stock <= 0;
                        $isLow = !is_null($product->stock) && $product->stock > 0 && $product->stock <= 5;
                        $isNew = $product->created_at && $product->created_at->diffInHours(now()) <= 24;
                    @endphp
                    <tr class="{{ $isOut ? 'table-row-danger' : ($isLow ? 'table-row-warning' : '') }}">

                        <td>
                            <a href="{{ asset('uploads/products/'.$product->image) }}" class="image-popup d-block"
                               style="width:60px;height:60px;border-radius:8px;overflow:hidden;border:1px solid var(--bd);display:block;">
                                <img src="{{ asset('uploads/products/'.$product->image) }}" alt="{{ $product->name }}"
                                     style="width:60px;height:60px;object-fit:cover;">
                            </a>
                        </td>

                        <td>
                            <div class="d-flex align-items-start gap-1 flex-column">
                                <span class="fw-600" style="font-size:13px;">{{ $product->name }}</span>
                                <div class="d-flex align-items-center gap-1 flex-wrap">
                                    <code style="font-size:10.5px;background:var(--bg);padding:1px 6px;border-radius:4px;color:var(--tx-3);">
                                        {{ $product->code_product }}
                                    </code>
                                    @if($isNew)
                                        <span class="badge badge-completed" style="font-size:9.5px;padding:2px 6px;">BARU</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td><span class="badge badge-brand">{{ optional($product->categories)->name ?? '—' }}</span></td>

                        <td>
                            @if(is_null($product->stock))
                                <span style="font-size:18px;color:var(--green);" title="Stok tidak terbatas">&infin;</span>
                            @elseif($isOut)
                                <span class="badge badge-cancelled">Habis</span>
                            @elseif($isLow)
                                <span class="badge badge-pending">{{ $product->stock }}</span>
                            @else
                                <span class="badge badge-completed">{{ number_format($product->stock) }}</span>
                            @endif
                        </td>

                        <td>
                            @if($product->discount > 0)
                                <div style="font-size:11px;color:var(--tx-4);text-decoration:line-through;">
                                    Rp {{ number_format($product->price,0,',','.') }}
                                </div>
                                <div class="d-flex align-items-center gap-1 flex-wrap">
                                    <span class="badge badge-pending" style="font-size:10px;">-{{ $product->discount }}%</span>
                                    <strong style="color:var(--br);font-size:13px;">
                                        Rp {{ number_format($product->final_price,0,',','.') }}
                                    </strong>
                                </div>
                            @else
                                <strong style="font-size:13px;">Rp {{ number_format($product->price,0,',','.') }}</strong>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($product->sizes_array as $sz)
                                    <span style="font-size:10px;font-weight:700;text-transform:uppercase;background:var(--bg);border:1px solid var(--bd);padding:1px 6px;border-radius:4px;color:var(--tx-2);">{{ $sz }}</span>
                                @endforeach
                            </div>
                        </td>

                        {{-- Status toggle + label teks --}}
                        <td>
                            <form action="{{ route('productsListStatusPut', $product->code_product) }}"
                                  method="POST" style="display:inline;">
                                @csrf @method('PUT')
                                <button type="button" class="confirm-status"
                                        style="background:transparent;border:none;padding:0;"
                                        aria-label="{{ $product->is_active ? 'Nonaktifkan' : 'Aktifkan' }} {{ $product->name }}"
                                        title="{{ $product->is_active ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}">
                                    <div class="is_active-toggle d-flex align-items-center">
                                        <input type="checkbox" id="tog_{{ $product->code_product }}"
                                               class="check" name="is_active" value="1"
                                               {{ $product->is_active ? 'checked' : '' }}>
                                        <label for="tog_{{ $product->code_product }}" class="checktoggle">checkbox</label>
                                    </div>
                                </button>
                            </form>
                            {{-- FIX: toggle label teks konsisten --}}
                            <span class="toggle-label-text {{ $product->is_active ? 'is-active' : 'is-inactive' }}">
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ url('/product-list/edit-product-list/'.strtolower($product->code_product)) }}"
                                   class="btn btn-sm btn-secondary"
                                   aria-label="Edit produk {{ $product->name }}"
                                   title="Edit produk">
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 000-1.41l-2.34-2.34a1 1 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-soft-danger btn-delete"
                                        data-form="form-del-prod-{{ $product->code_product }}"
                                        data-name="{{ $product->name }}"
                                        data-type="Produk"
                                        aria-label="Hapus produk {{ $product->name }}"
                                        title="Hapus produk">
                                    <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                    </svg>
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
                            <svg width="44" height="44" fill="currentColor" viewBox="0 0 24 24"
                                 style="color:var(--br-lt);opacity:.4;display:block;margin:0 auto 10px;">
                                <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
                            </svg>
                            <p class="mb-3" style="color:var(--tx-3);">Belum ada produk tersimpan.</p>
                            <a href="{{ url('/product-list/add-product-list') }}" class="btn btn-primary btn-sm">
                                <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                                Tambah Produk Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
