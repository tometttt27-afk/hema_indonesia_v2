@extends('template.layout-main')
@section('title_web', 'Produk | Hema.Indonesia')
@section('content-main')

<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list"><li><a href="{{ url('/') }}">Beranda</a></li><li>Produk</li></ol>
        <h2 class="page-hero">Katalog <span style="color:#b17457;">Produk</span></h2>
        <p>Temukan koleksi gamis premium pilihan kami</p>
    </div>
</div>

<section class="container py-12 pb-20">

    {{-- Filter bar --}}
    <form method="GET" action="{{ url('/product') }}"
        class="mb-8 rounded-xl p-5"
        style="background:#fff;border:1.5px solid #ede3db;box-shadow:0 2px 8px rgba(177,116,87,.06);">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-3 items-end">
            <div class="xl:col-span-2">
                <label class="label-brand">Cari Produk</label>
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Nama produk..."
                    autocomplete="off" class="input-brand">
            </div>
            <div>
                <label class="label-brand">Kategori</label>
                <select name="category" class="input-brand">
                    <option value="">Semua</option>
                    @foreach($categories_product as $cat)
                        <option value="{{ $cat->category_code }}" {{ request('category')==$cat->category_code?'selected':'' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label-brand">Harga Min</label>
                <input type="number" name="min_price" value="{{ request('min_price') }}" min="0" placeholder="0" class="input-brand">
            </div>
            <div>
                <label class="label-brand">Harga Max</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}" min="0" placeholder="-" class="input-brand">
            </div>
            <div>
                <label class="label-brand">Urutkan</label>
                <select name="sort" class="input-brand">
                    <option value="newest" {{ request('sort')=='newest'?'selected':'' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort')=='oldest'?'selected':'' }}>Terlama</option>
                    <option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>Harga Termurah</option>
                    <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Harga Termahal</option>
                    <option value="name_asc" {{ request('sort')=='name_asc'?'selected':'' }}>Nama A-Z</option>
                </select>
            </div>
            <div class="xl:col-span-4 flex flex-wrap items-center gap-5">
                <label class="flex items-center gap-2 text-sm cursor-pointer font-medium text-gray-700">
                    <input type="checkbox" name="in_stock" value="1" {{ request('in_stock')?'checked':'' }} class="w-4 h-4 rounded" style="accent-color:#b17457;">
                    Stok tersedia
                </label>
                <label class="flex items-center gap-2 text-sm cursor-pointer font-medium text-gray-700">
                    <input type="checkbox" name="on_sale" value="1" {{ request('on_sale')?'checked':'' }} class="w-4 h-4 rounded" style="accent-color:#b17457;">
                    Sedang diskon
                </label>
            </div>
            <div class="xl:col-span-2 flex gap-2 justify-end">
                <a href="{{ url('/product') }}"
                   class="btn-outline-brand btn-brand-sm px-5">Reset</a>
                <button type="submit" class="btn-brand btn-brand-sm px-6">
                    <i class="fas fa-filter text-xs"></i> Filter
                </button>
            </div>
        </div>
    </form>

    {{-- Header row --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <h2 class="font-bold text-xl text-gray-900">Produk</h2>
            <span class="text-sm font-bold text-white px-3 py-1 rounded-full"
                style="background:linear-gradient(135deg,#b17457,#c29470);">{{ $count_product }}</span>
        </div>
    </div>

    {{-- Product grid --}}
    @forelse($data as $product)
    @php
        $sizes = $product->size ? array_map('trim', explode(',', $product->size)) : [];
        $isOut = !is_null($product->stock) && $product->stock <= 0;
        $isLow = !is_null($product->stock) && $product->stock > 0 && $product->stock <= 5;
    @endphp
    @if($loop->first)
    <div class="grid grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6" id="product_list">
    @endif
        <div class="product-card">
            <div class="product-img" style="height:240px;overflow:hidden;">
                <img class="w-full h-full object-cover"
                    src="{{ asset('uploads/products/'.$product->image) }}" alt="{{ $product->name }}">
                @if($product->discount > 0)
                    <span class="badge-discount">-{{ $product->discount }}%</span>
                @endif
                @auth
                <form action="{{ route('wishlistStore', $product->id) }}" method="post"
                    class="absolute top-2 right-2 z-10">
                    @csrf
                    <button type="submit" title="Wishlist"
                        class="w-9 h-9 rounded-full bg-white/90 hover:bg-[#b17457] hover:text-white flex items-center justify-center shadow transition-all">
                        <i class="far fa-heart text-sm"></i>
                    </button>
                </form>
                @endauth
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-2">{{ $product->name }}</h3>
                <div class="flex items-center gap-2 flex-wrap mb-3">
                    @if($product->discount > 0)
                        <span class="text-xs text-gray-400 line-through">Rp. {{ number_format($product->price,0,',','.') }}</span>
                        <span class="text-sm font-bold" style="color:#b17457;">Rp. {{ number_format($product->final_price,0,',','.') }}</span>
                    @else
                        <span class="text-sm font-bold" style="color:#b17457;">Rp. {{ number_format($product->price,0,',','.') }}</span>
                    @endif
                </div>
                @if($isOut)<span class="badge-out">Stok Habis</span>
                @elseif($isLow)<span class="badge-low">Sisa {{ $product->stock }}</span>
                @endif
                <form action="{{ route('cartStore') }}" method="post" class="mt-3">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="1">
                    <div class="flex flex-wrap gap-1.5 mb-3">
                        @foreach($sizes as $i => $size)
                        <label class="size-label cursor-pointer">
                            <input type="radio" name="size" value="{{ $size }}" {{ $i===0?'checked':'' }}>
                            <span class="size-pill">{{ strtoupper($size) }}</span>
                        </label>
                        @endforeach
                    </div>
                    @if($isOut)
                        <button type="button" disabled class="w-full py-2 rounded-lg text-sm font-semibold text-gray-400 cursor-not-allowed" style="background:#f3f4f6;">Stok Habis</button>
                    @elseif(auth()->check())
                        <button type="submit" class="btn-brand w-full py-2 text-sm rounded-lg">
                            <i class="fas fa-cart-shopping text-xs"></i> Tambah ke Keranjang
                        </button>
                    @else
                        <a href="{{ url('/auth/sign-in') }}" class="btn-brand w-full py-2 text-sm rounded-lg text-center block">
                            <i class="fas fa-cart-shopping text-xs"></i> Login untuk Beli
                        </a>
                    @endif
                </form>
            </div>
        </div>
    @if($loop->last)</div>@endif
    @empty
    <div class="empty-state"><i class="fas fa-box-open"></i><p>Produk tidak ditemukan.</p></div>
    @endforelse

    {{-- Pagination --}}
    @if($data->hasPages())
    <div class="flex flex-wrap justify-center items-center gap-2 mt-12 pt-8" style="border-top:1px solid #ede3db;">
        @if($data->onFirstPage())
            <span class="px-3 py-2 text-sm rounded-lg text-gray-300 cursor-not-allowed" style="border:1.5px solid #ede3db;"><i class="fas fa-chevron-left"></i></span>
        @else
            <a href="{{ $data->previousPageUrl() }}" class="px-3 py-2 text-sm rounded-lg transition-all" style="border:1.5px solid #ede3db;color:#374151;" onmouseover="this.style.background='#b17457';this.style.color='#fff';this.style.borderColor='#b17457';" onmouseout="this.style.background='';this.style.color='#374151';this.style.borderColor='#ede3db';"><i class="fas fa-chevron-left"></i></a>
        @endif
        <span class="px-4 py-2 text-sm text-gray-600">Halaman {{ $data->currentPage() }} / {{ $data->lastPage() }}</span>
        @if($data->hasMorePages())
            <a href="{{ $data->nextPageUrl() }}" class="px-3 py-2 text-sm rounded-lg transition-all" style="border:1.5px solid #ede3db;color:#374151;" onmouseover="this.style.background='#b17457';this.style.color='#fff';this.style.borderColor='#b17457';" onmouseout="this.style.background='';this.style.color='#374151';this.style.borderColor='#ede3db';"><i class="fas fa-chevron-right"></i></a>
        @else
            <span class="px-3 py-2 text-sm rounded-lg text-gray-300 cursor-not-allowed" style="border:1.5px solid #ede3db;"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>
    @endif
</section>

@endsection
