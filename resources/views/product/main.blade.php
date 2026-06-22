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
        <div class="header-title flex lg:flex-row flex-col justify-between items-start lg:items-center">
            <div class="title flex items-center gap-3">
                <h1 class="text-xl font-semibold">Sale Produk</h1>
                <h4 class="px-3 rounded-sm font-semibold text-white py-1.5 bg-gradient-to-r from-primary to-secondary">
                    {{ $count_product }}
                </h4>
            </div>
            <div class="filter">
                <input oninput="filterSearchProduct(event)"
                    class="text-sm focus:border-primary tracking-wider inline-block cursor-pointer mt-3 px-4 py-[8px] outline-none rounded-sm  border-[1.5px] border-[#f1f1f1]"
                    autocomplete="off" type="search" name="search" id="search_product" placeholder="Searching...">
                <select onchange="filterSelectCategory(event)"
                    class="text-sm bg-white focus:border-primary tracking-wider inline-block cursor-pointer mt-3 px-4 py-[8px] outline-none rounded-sm  border-[1.5px] border-[#f1f1f1]"
                    name="category_product" id="category_product">
                    <option value="all">All</option>
                    @foreach ($categories_product as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="content" id="product main">
            <main id="product_list" class="grid grid-cols-2 xl:grid-cols-3 gap-4 md:gap-8 mt-12">
                @foreach ($data as $product)
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
                @endforeach
            </main>
            <div class="w-full text-[13px] md:text[14.5px] lg:text-[16px] hidden px-3 py-6 justify-center items-center text-center shadow-sm border-[0.5px] border-gray-200 rounded"
                id="product_not_found">
                <p class="tracking-wider"><i class="fas fa-magnifying-glass"></i> Pencarian produk tidak ditemukan!</p>
            </div>
            <div id="main_product_pagination" class="w-full border-t border-gray-200 font-mono mt-16">
                <nav id="product_pagination" class="pagination flex flex-wrap justify-center text-gray-700 -mt-px">
                    <button type="button" id="prev-product"
                        class="px-2 text-[12px] md:text-sm py-[11px] lg:py-3 xl:py-2.5 mx-1 border-t border-transparent hover:border-gray-700">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button id="next-product" type="button"
                        class="px-2 text-[12px] md:text-sm py-[11px] lg:py-3 xl:py-2.5 mx-1 border-t border-transparent hover:border-gray-700">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </nav>
            </div>
        </div>
    </section>
@endsection
