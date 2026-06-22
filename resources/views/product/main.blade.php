@extends('template.layout-main')
@section('title_web', 'Produk | Hema.Indonesia')
@section('content-main')
    <div id="hero" class="header-hero bg-[#f5f5f5]">
        <div class="container pt-10 pb-11">
            <div class="block">
                <nav aria-label="breadcrumb" class="w-full">
                    <ol class="flex w-full flex-wrap items-center mb-2">
                        <li
                            class="flex cursor-pointer items-center text-sm text-gray-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="{{ url('/') }}">Beranda</a>
                            <span class="pointer-events-none mx-2 text-slate-800">
                                /
                            </span>
                        </li>
                        <li
                            class="flex cursor-pointer items-center text-sm text-gray-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="{{ url('/product') }}">Produk</a>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-[20px] md:text-2xl font-bold">
                    Produk | <span class="text-primary">Hema</span>.Indonesia
                </h2>
                <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, id?</p>
            </div>
        </div>
    </div>

    <section id="product_section" class="product container pt-12 pb-24">
        <div class="header-title flex lg:flex-row flex-col justify-between items-start lg:items-center gap-4">
            <div class="title flex items-center gap-3">
                <h1 class="text-xl font-semibold">Produk</h1>
                <h4 class="px-3 rounded-sm font-semibold text-white py-1.5 bg-gradient-to-r from-primary to-secondary">
                    {{ $count_product }}
                </h4>
            </div>
        </div>

        <form method="GET" action="{{ url('/product') }}"
            class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-3 items-end bg-[#f9f9f9] border border-gray-100 rounded p-4">
            <div class="xl:col-span-2">
                <label class="block text-[12px] text-gray-500 mb-1">Cari Produk</label>
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Nama atau deskripsi..."
                    autocomplete="off"
                    class="w-full text-sm focus:border-primary px-3 py-[8px] outline-none rounded-sm border-[1.5px] border-gray-200">
            </div>
            <div>
                <label class="block text-[12px] text-gray-500 mb-1">Kategori</label>
                <select name="category"
                    class="w-full bg-white text-sm focus:border-primary px-3 py-[8px] outline-none rounded-sm border-[1.5px] border-gray-200">
                    <option value="">Semua</option>
                    @foreach ($categories_product as $category)
                        <option value="{{ $category->category_code }}"
                            {{ request('category') == $category->category_code ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[12px] text-gray-500 mb-1">Harga Min</label>
                <input type="number" name="min_price" value="{{ request('min_price') }}" min="0" placeholder="0"
                    class="w-full text-sm focus:border-primary px-3 py-[8px] outline-none rounded-sm border-[1.5px] border-gray-200">
            </div>
            <div>
                <label class="block text-[12px] text-gray-500 mb-1">Harga Max</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}" min="0" placeholder="-"
                    class="w-full text-sm focus:border-primary px-3 py-[8px] outline-none rounded-sm border-[1.5px] border-gray-200">
            </div>
            <div>
                <label class="block text-[12px] text-gray-500 mb-1">Urutkan</label>
                <select name="sort"
                    class="w-full bg-white text-sm focus:border-primary px-3 py-[8px] outline-none rounded-sm border-[1.5px] border-gray-200">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Termurah
                    </option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Termahal
                    </option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                </select>
            </div>
            <div class="xl:col-span-4 flex flex-wrap items-center gap-4">
                <label class="flex items-center gap-2 text-sm cursor-pointer">
                    <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }}>
                    Hanya yang tersedia
                </label>
                <label class="flex items-center gap-2 text-sm cursor-pointer">
                    <input type="checkbox" name="on_sale" value="1" {{ request('on_sale') ? 'checked' : '' }}>
                    Sedang diskon
                </label>
            </div>
            <div class="xl:col-span-2 flex gap-2 justify-end">
                <a href="{{ url('/product') }}"
                    class="text-sm border border-gray-300 text-gray-600 rounded-sm px-5 py-[9px] hover:bg-gray-100">Reset</a>
                <button type="submit"
                    class="text-sm bg-gradient-to-r from-primary to-secondary text-white font-medium rounded-sm px-6 py-[9px] hover:opacity-90">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </form>
        <div class="content" id="product main">
            <main id="product_list" class="grid grid-cols-2 xl:grid-cols-3 gap-4 md:gap-8 mt-12">
                @forelse ($data as $product)
                    <div class="product_box shadow-sm shadow-gray-200 border border-gray-100 hover:shadow-primary"
                        data-category="{{ $product->categories->name }}" id="product_box">
                        <div class="img w-full relative">
                            <img class="w-full h-[200px] md:h-[500px] object-cover"
                                src="{{ asset('uploads/products/' . $product->image) }}" alt="">
                            @auth
                                <form action="{{ route('wishlistStore', $product->id) }}" method="post"
                                    class="absolute top-2 right-2 z-10">
                                    @csrf
                                    <button type="submit" title="Tambah ke wishlist"
                                        class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/90 hover:bg-primary hover:text-white flex items-center justify-center shadow">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </form>
                            @endauth
                        </div>
                        <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                            <h3 class="text-sm md:text-[16px] font-medium">{{ $product->name }}</h3>
                            @if ($product->discount > 0)
                                <div class="flex items-center gap-2">
                                    <div class="flex gap-1 items-center">
                                        <p class="text-[12px] md:text-sm text-black">
                                            <strike>Rp. {{ number_format($product->price, 0, ',', '.') }}</strike>
                                        </p>
                                        <p class="text-[12px] md:text-sm text-black">- {{ $product->discount }}%</p>
                                    </div>
                                    <p>|</p>
                                    <p class="text-[12px] md:text-sm text-red-500"> Rp.
                                        {{ number_format($product->final_price, 0, ',', '.') }}</p>
                                </div>
                            @else
                                <p class="text-[12px] md:text-sm text-red-500">Rp.
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                            @endif

                            @php
                                $sizes = $product->size ? array_map('trim', explode(',', $product->size)) : [];
                                $stock = $product->stock;
                                $isOut = !is_null($stock) && $stock <= 0;
                                $isLow = !is_null($stock) && $stock > 0 && $stock <= 5;
                            @endphp
                            @if ($isOut)
                                <span class="text-[11px] md:text-xs font-medium px-2 py-1 rounded-full bg-red-100 text-red-600">Stok
                                    Habis</span>
                            @elseif ($isLow)
                                <span class="text-[11px] md:text-xs font-medium px-2 py-1 rounded-full bg-yellow-100 text-yellow-700">Sisa
                                    {{ $stock }}</span>
                            @endif
                            <form action="{{ route('cartStore') }}" method="post"
                                class="w-full flex flex-col items-center gap-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="qty" value="1">
                                <div class="size flex flex-wrap justify-center items-center gap-2 text-[9.5px] md:text-xs">
                                    @foreach ($sizes as $i => $size)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="size" value="{{ $size }}" class="peer hidden"
                                                {{ $i === 0 ? 'checked' : '' }}>
                                            <span
                                                class="w-5 h-5 md:w-7 md:h-7 rounded-sm font-medium flex justify-center items-center text-white bg-gray-300 peer-checked:bg-gradient-to-r peer-checked:from-primary peer-checked:to-secondary">{{ strtoupper($size) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @if ($isOut)
                                    <button type="button" disabled
                                        class="w-full bg-gray-300 text-white text-[11px] md:text-sm font-medium rounded-sm py-2 cursor-not-allowed">
                                        Stok Habis
                                    </button>
                                @elseif (auth()->check())
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-primary to-secondary text-white text-[11px] md:text-sm font-medium rounded-sm py-2 hover:opacity-90">
                                        <i class="fas fa-cart-shopping"></i> Tambah ke Keranjang
                                    </button>
                                @else
                                    <a href="{{ url('/auth/sign-in') }}"
                                        class="w-full text-center bg-gradient-to-r from-primary to-secondary text-white text-[11px] md:text-sm font-medium rounded-sm py-2 hover:opacity-90">
                                        <i class="fas fa-cart-shopping"></i> Login untuk Beli
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 xl:col-span-3"></div>
                @endforelse
            </main>

            @if ($data->isEmpty())
                <div class="w-full text-[13px] md:text-[14.5px] lg:text-[16px] px-3 py-6 flex justify-center items-center text-center shadow-sm border-[0.5px] border-gray-200 rounded mt-12"
                    id="product_not_found">
                    <p class="tracking-wider"><i class="fas fa-magnifying-glass"></i> Produk tidak ditemukan. Coba ubah
                        kata kunci atau filter.</p>
                </div>
            @endif

            @if ($data->hasPages())
                <div class="w-full border-t border-gray-200 mt-16 pt-6 flex flex-wrap justify-center items-center gap-2">
                    @if ($data->onFirstPage())
                        <span
                            class="px-3 py-2 text-sm rounded-sm border border-gray-200 text-gray-300 cursor-not-allowed"><i
                                class="fa-solid fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $data->previousPageUrl() }}"
                            class="px-3 py-2 text-sm rounded-sm border border-gray-200 hover:bg-primary hover:text-white"><i
                                class="fa-solid fa-chevron-left"></i></a>
                    @endif

                    <span class="px-4 py-2 text-sm text-gray-600">Halaman {{ $data->currentPage() }} dari
                        {{ $data->lastPage() }}</span>

                    @if ($data->hasMorePages())
                        <a href="{{ $data->nextPageUrl() }}"
                            class="px-3 py-2 text-sm rounded-sm border border-gray-200 hover:bg-primary hover:text-white"><i
                                class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span
                            class="px-3 py-2 text-sm rounded-sm border border-gray-200 text-gray-300 cursor-not-allowed"><i
                                class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </div>
            @endif
        </div>
    </section>
@endsection
