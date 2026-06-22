@extends('template.layout-main')
@section('title_web', 'Katalog Produk | Hema.Indonesia')
@section('content-main')

{{-- ═══ PAGE HERO ═══ --}}
<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li>Produk</li>
        </ol>
        <h2>Katalog <span style="color:#b17457;">Produk</span></h2>
        <p>Temukan koleksi gamis premium pilihan kami — diperbarui langsung oleh admin</p>
    </div>
</div>

<section class="container py-10 pb-20">

    {{-- ═══ FILTER BAR ═══ --}}
    {{--
        Data yang ditampilkan di sini adalah hasil query REAL-TIME dari
        tabel 'products' (is_active=1, latestFirst).
        Admin menambah/mengubah produk → langsung tercermin di sini
        tanpa cache / tanpa rebuild.
    --}}
    <form method="GET" action="{{ url('/product') }}" id="filter-form"
          class="mb-8 rounded-xl p-5"
          style="background:#fff;border:1.5px solid #ede3db;
                 box-shadow:0 2px 8px rgba(177,116,87,.06);">

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-3 items-end">

            {{-- Cari --}}
            <div class="xl:col-span-2">
                <label class="label-brand">Cari Produk</label>
                <div class="relative">
                    <input type="search" name="q" value="{{ request('q') }}"
                           placeholder="Nama produk…"
                           autocomplete="off"
                           class="input-brand"
                           style="padding-left:38px;">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2"
                       style="color:#a89080;font-size:13px;"></i>
                </div>
            </div>

            {{-- Kategori — diambil dari DB (inject oleh ProductsController::index) --}}
            <div>
                <label class="label-brand">Kategori</label>
                <select name="category" class="input-brand">
                    <option value="">Semua Kategori</option>
                    @foreach($categories_product as $cat)
                        <option value="{{ $cat->category_code }}"
                            {{ request('category') === $cat->category_code ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Harga Min --}}
            <div>
                <label class="label-brand">Harga Min (Rp)</label>
                <input type="number" name="min_price"
                       value="{{ request('min_price') }}" min="0" step="1000"
                       placeholder="0" class="input-brand">
            </div>

            {{-- Harga Max --}}
            <div>
                <label class="label-brand">Harga Max (Rp)</label>
                <input type="number" name="max_price"
                       value="{{ request('max_price') }}" min="0" step="1000"
                       placeholder="Semua" class="input-brand">
            </div>

            {{-- Urutkan --}}
            <div>
                <label class="label-brand">Urutkan</label>
                <select name="sort" class="input-brand">
                    @foreach([
                        'newest'     => 'Terbaru',
                        'oldest'     => 'Terlama',
                        'price_asc'  => 'Harga Termurah',
                        'price_desc' => 'Harga Termahal',
                        'name_asc'   => 'Nama A–Z',
                        'name_desc'  => 'Nama Z–A',
                    ] as $val => $lbl)
                    <option value="{{ $val }}" {{ request('sort', 'newest') === $val ? 'selected' : '' }}>
                        {{ $lbl }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Checkbox filters --}}
            <div class="xl:col-span-4 flex flex-wrap items-center gap-5 pt-1">
                <label class="flex items-center gap-2 text-sm font-medium text-gray-700 cursor-pointer select-none">
                    <input type="checkbox" name="in_stock" value="1"
                           {{ request('in_stock') ? 'checked' : '' }}
                           class="w-4 h-4 rounded" style="accent-color:#b17457;">
                    <span>Stok tersedia</span>
                </label>
                <label class="flex items-center gap-2 text-sm font-medium text-gray-700 cursor-pointer select-none">
                    <input type="checkbox" name="on_sale" value="1"
                           {{ request('on_sale') ? 'checked' : '' }}
                           class="w-4 h-4 rounded" style="accent-color:#b17457;">
                    <span>Sedang diskon</span>
                </label>
            </div>

            {{-- Tombol aksi filter --}}
            <div class="xl:col-span-2 flex gap-2 justify-end">
                @if(request()->hasAny(['q','category','min_price','max_price','sort','in_stock','on_sale']))
                    <a href="{{ url('/product') }}"
                       class="btn-outline-brand btn-brand-sm px-5 inline-flex items-center gap-1">
                        <i class="fas fa-xmark text-xs"></i> Reset
                    </a>
                @endif
                <button type="submit"
                        class="btn-brand btn-brand-sm px-6 inline-flex items-center gap-1">
                    <i class="fas fa-filter text-xs"></i> Filter
                </button>
            </div>

        </div>
    </form>

    {{-- ═══ RESULT HEADER ═══ --}}
    <div class="flex items-center justify-between flex-wrap gap-3 mb-6">
        <div class="flex items-center gap-3">
            <h2 class="font-bold text-xl text-gray-900">Produk</h2>
            <span class="text-sm font-bold text-white px-3 py-1 rounded-full"
                  style="background:linear-gradient(135deg,#b17457,#c29470);">
                {{ $count_product }}
            </span>
            @if(request()->hasAny(['q','category','min_price','max_price','in_stock','on_sale']))
                <span class="text-xs text-gray-400 font-medium">
                    — hasil filter
                </span>
            @endif
        </div>

        {{-- Active filter chips --}}
        <div class="flex flex-wrap gap-2">
            @if(request('q'))
                <span class="inline-flex items-center gap-1 text-xs px-3 py-1 rounded-full font-semibold"
                      style="background:#faf0ea;color:#8a5538;border:1px solid #e8ddd7;">
                    <i class="fas fa-search text-[10px]"></i> "{{ request('q') }}"
                </span>
            @endif
            @if(request('category'))
                @php $catName = $categories_product->firstWhere('category_code', request('category'))?->name; @endphp
                @if($catName)
                <span class="inline-flex items-center gap-1 text-xs px-3 py-1 rounded-full font-semibold"
                      style="background:#faf0ea;color:#8a5538;border:1px solid #e8ddd7;">
                    <i class="fas fa-tag text-[10px]"></i> {{ $catName }}
                </span>
                @endif
            @endif
            @if(request('in_stock'))
                <span class="inline-flex items-center gap-1 text-xs px-3 py-1 rounded-full font-semibold"
                      style="background:#f0fdf6;color:#14532d;border:1px solid #bbf7d0;">
                    <i class="fas fa-check text-[10px]"></i> Stok tersedia
                </span>
            @endif
            @if(request('on_sale'))
                <span class="inline-flex items-center gap-1 text-xs px-3 py-1 rounded-full font-semibold"
                      style="background:#fffbeb;color:#78350f;border:1px solid #fde68a;">
                    <i class="fas fa-percent text-[10px]"></i> Diskon
                </span>
            @endif
        </div>
    </div>

    {{-- ═══ PRODUCT GRID ═══ --}}
    {{--
        Loop ini me-render produk langsung dari hasil SELECT DB:
        ProductsModel::active()->latestFirst()->paginate(12)
        Produk baru yang ditambahkan admin (is_active=1) akan muncul
        di halaman pertama grid ini tanpa tindakan tambahan.
    --}}
    @forelse($data as $product)
        @php
            $sizes  = $product->sizes_array;       // accessor: array dari CSV
            $isOut  = $product->is_out_of_stock;   // accessor: bool
            $isLow  = $product->is_low_stock;      // accessor: bool
        @endphp
        @if($loop->first)
        <div class="grid grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6">
        @endif

        {{-- ── Product Card ── --}}
        <div class="product-card flex flex-col">

            {{-- Gambar --}}
            <div class="product-img relative" style="height:240px;overflow:hidden;flex-shrink:0;">
                <img class="w-full h-full object-cover"
                     src="{{ $product->image_url }}"
                     alt="{{ $product->name }}"
                     loading="lazy">

                {{-- Badge diskon --}}
                @if($product->discount > 0)
                    <span class="badge-discount">-{{ $product->discount }}%</span>
                @endif

                {{-- Badge stok habis overlay --}}
                @if($isOut)
                    <div class="absolute inset-0 flex items-center justify-center"
                         style="background:rgba(0,0,0,.45);">
                        <span class="text-white font-bold text-sm px-3 py-1 rounded-full"
                              style="background:rgba(220,38,38,.85);">Stok Habis</span>
                    </div>
                @endif

                {{-- Wishlist button --}}
                @auth
                    <form action="{{ route('wishlistStore', $product->id) }}" method="POST"
                          class="absolute top-2 right-2 z-10">
                        @csrf
                        <button type="submit"
                                title="Tambah ke Wishlist"
                                class="w-9 h-9 rounded-full flex items-center justify-center
                                       shadow-md transition-all duration-200"
                                style="background:rgba(255,255,255,.92);color:#b17457;"
                                onmouseover="this.style.background='#b17457';this.style.color='#fff';"
                                onmouseout="this.style.background='rgba(255,255,255,.92)';this.style.color='#b17457';">
                            <i class="far fa-heart text-sm"></i>
                        </button>
                    </form>
                @endauth
            </div>

            {{-- Konten card --}}
            <div class="p-4 flex flex-col flex-1">

                {{-- Kategori & Nama --}}
                <p class="text-xs font-medium mb-1"
                   style="color:#a89080;">
                    {{ optional($product->categories)->name }}
                </p>
                <h3 class="font-semibold text-gray-900 text-sm leading-snug mb-2"
                    style="display:-webkit-box;-webkit-line-clamp:2;
                           -webkit-box-orient:vertical;overflow:hidden;">
                    {{ $product->name }}
                </h3>

                {{-- Harga --}}
                <div class="flex items-center gap-2 flex-wrap mb-3">
                    @if($product->discount > 0)
                        <span class="text-xs text-gray-400 line-through">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        <span class="text-sm font-bold" style="color:#b17457;">
                            Rp {{ number_format($product->final_price, 0, ',', '.') }}
                        </span>
                    @else
                        <span class="text-sm font-bold" style="color:#b17457;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    @endif
                    @if($isLow)
                        <span class="badge-low">Sisa {{ $product->stock }}</span>
                    @endif
                </div>

                {{-- Spacer agar tombol selalu di bawah --}}
                <div class="flex-1"></div>

                {{-- ── Add to Cart Form ────────────────────────────────
                     WCAG Contrast rules untuk tombol:
                     • Aktif → btn-brand: bg gradient #b17457→#c29470, teks #fff (≥4.7:1)
                     • Stok habis → bg #f3f4f6 abu, teks #9ca3af (indikasi, disabled)
                     • Guest → sama dgn aktif, action = redirect sign-in
                ──────────────────────────────────────────────────────── --}}
                @if($isOut)
                    {{-- Stok habis: tombol disabled — kontras abu bg/teks --}}
                    <button type="button" disabled
                            class="w-full py-2.5 rounded-lg text-sm font-semibold
                                   cursor-not-allowed select-none"
                            style="background:#f3f4f6;color:#9ca3af;border:none;">
                        <i class="fas fa-ban text-xs me-1"></i> Stok Habis
                    </button>

                @else
                    <form action="{{ route('cartStore') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="1">

                        {{-- Size selector — radio pill --}}
                        @if(count($sizes))
                        <div class="flex flex-wrap gap-1.5 mb-3">
                            @foreach($sizes as $i => $size)
                            <label class="size-label cursor-pointer" title="{{ strtoupper($size) }}">
                                <input type="radio" name="size"
                                       value="{{ $size }}"
                                       {{ $i === 0 ? 'checked' : '' }}
                                       required>
                                <span class="size-pill">{{ strtoupper($size) }}</span>
                            </label>
                            @endforeach
                        </div>
                        @endif

                        {{-- CTA button --}}
                        @auth
                            {{-- User login → tambah ke keranjang --}}
                            <button type="submit"
                                    class="btn-brand w-full py-2.5 text-sm rounded-lg
                                           inline-flex items-center justify-center gap-2">
                                <i class="fas fa-cart-shopping text-xs"></i>
                                Tambah ke Keranjang
                            </button>
                        @else
                            {{-- Guest → arahkan ke sign-in --}}
                            <a href="{{ url('/auth/sign-in') }}"
                               class="btn-brand w-full py-2.5 text-sm rounded-lg
                                      inline-flex items-center justify-center gap-2
                                      text-center"
                               style="text-decoration:none;">
                                <i class="fas fa-right-to-bracket text-xs"></i>
                                Login untuk Beli
                            </a>
                        @endauth

                    </form>
                @endif

            </div>{{-- /card body --}}
        </div>{{-- /product-card --}}

        @if($loop->last)</div>@endif
    @empty
        {{-- ── Empty state ── --}}
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <p class="mt-3 font-semibold text-gray-600">Produk tidak ditemukan.</p>
            @if(request()->hasAny(['q','category','min_price','max_price','in_stock','on_sale']))
                <p class="text-sm text-gray-400 mt-1">Coba ubah atau hapus filter pencarian.</p>
                <a href="{{ url('/product') }}"
                   class="btn-outline-brand mt-4 inline-flex items-center gap-2 px-5 py-2.5 text-sm rounded-lg">
                    <i class="fas fa-xmark text-xs"></i> Hapus Semua Filter
                </a>
            @else
                <p class="text-sm text-gray-400 mt-1">Admin belum menambahkan produk aktif.</p>
            @endif
        </div>
    @endforelse

    {{-- ═══ PAGINATION ═══ --}}
    @if($data->hasPages())
    <div class="flex flex-wrap justify-center items-center gap-2 mt-12 pt-8"
         style="border-top:1px solid #ede3db;">

        {{-- Prev --}}
        @if($data->onFirstPage())
            <span class="px-3 py-2 text-sm rounded-lg cursor-not-allowed select-none"
                  style="border:1.5px solid #ede3db;color:#d1d5db;">
                <i class="fas fa-chevron-left text-xs"></i>
            </span>
        @else
            <a href="{{ $data->previousPageUrl() }}"
               class="px-3 py-2 text-sm rounded-lg font-medium transition-all"
               style="border:1.5px solid #ede3db;color:#374151;text-decoration:none;"
               onmouseover="this.style.background='#b17457';this.style.color='#fff';this.style.borderColor='#b17457';"
               onmouseout="this.style.background='';this.style.color='#374151';this.style.borderColor='#ede3db';">
                <i class="fas fa-chevron-left text-xs"></i>
            </a>
        @endif

        {{-- Page numbers --}}
        @foreach($data->getUrlRange(max(1,$data->currentPage()-2), min($data->lastPage(),$data->currentPage()+2)) as $page => $url)
            @if($page === $data->currentPage())
                <span class="px-3.5 py-2 text-sm rounded-lg font-bold text-white"
                      style="background:linear-gradient(135deg,#b17457,#c29470);
                             border:1.5px solid #b17457;min-width:38px;text-align:center;">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}"
                   class="px-3.5 py-2 text-sm rounded-lg font-medium transition-all"
                   style="border:1.5px solid #ede3db;color:#374151;text-decoration:none;
                          min-width:38px;text-align:center;"
                   onmouseover="this.style.background='#faf0ea';this.style.borderColor='#d4a882';"
                   onmouseout="this.style.background='';this.style.borderColor='#ede3db';">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        {{-- Info --}}
        <span class="px-3 py-2 text-xs text-gray-400 font-medium select-none">
            {{ $data->currentPage() }} / {{ $data->lastPage() }}
        </span>

        {{-- Next --}}
        @if($data->hasMorePages())
            <a href="{{ $data->nextPageUrl() }}"
               class="px-3 py-2 text-sm rounded-lg font-medium transition-all"
               style="border:1.5px solid #ede3db;color:#374151;text-decoration:none;"
               onmouseover="this.style.background='#b17457';this.style.color='#fff';this.style.borderColor='#b17457';"
               onmouseout="this.style.background='';this.style.color='#374151';this.style.borderColor='#ede3db';">
                <i class="fas fa-chevron-right text-xs"></i>
            </a>
        @else
            <span class="px-3 py-2 text-sm rounded-lg cursor-not-allowed select-none"
                  style="border:1.5px solid #ede3db;color:#d1d5db;">
                <i class="fas fa-chevron-right text-xs"></i>
            </span>
        @endif

    </div>
    @endif

</section>

@endsection
