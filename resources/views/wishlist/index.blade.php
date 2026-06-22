@extends('template.layout-main')
@section('title_web', 'Wishlist | Hema.Indonesia')
@section('content-main')
    <div id="hero" class="header-hero bg-[#f5f5f5]">
        <div class="container pt-10 pb-11">
            <nav aria-label="breadcrumb" class="w-full">
                <ol class="flex w-full flex-wrap items-center mb-2">
                    <li class="flex items-center text-sm text-gray-500 hover:text-slate-800">
                        <a href="{{ url('/') }}">Beranda</a>
                        <span class="pointer-events-none mx-2 text-slate-800">/</span>
                    </li>
                    <li class="flex items-center text-sm text-gray-500 hover:text-slate-800">
                        <a href="{{ url('/wishlist') }}">Wishlist</a>
                    </li>
                </ol>
            </nav>
            <h2 class="text-[20px] md:text-2xl font-bold">Wishlist <span class="text-primary">Saya</span></h2>
            <p class="text-gray-500">Produk favorit yang anda simpan</p>
        </div>
    </div>

    <section class="container py-16">
        @if ($data->isEmpty())
            <div class="text-center py-20 border border-gray-200 rounded">
                <i class="far fa-heart text-4xl text-gray-300"></i>
                <p class="mt-4 text-gray-500">Wishlist anda masih kosong.</p>
                <a href="{{ url('/product') }}"
                    class="inline-block mt-4 bg-gradient-to-r from-primary to-secondary text-white text-sm font-medium rounded-sm px-6 py-[10px] hover:opacity-90">Jelajahi
                    Produk</a>
            </div>
        @else
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6">
                @foreach ($data as $item)
                    @if ($item->product)
                        <div class="border border-gray-100 shadow-sm shadow-gray-200 hover:shadow-primary">
                            <a href="{{ url('/product') }}" class="block">
                                <img class="w-full h-[180px] md:h-[260px] object-cover"
                                    src="{{ asset('uploads/products/' . $item->product->image) }}" alt="">
                            </a>
                            <div class="flex flex-col items-center gap-2 py-4 px-3 text-center">
                                <h3 class="text-sm md:text-[16px] font-medium">{{ $item->product->name }}</h3>
                                @if ($item->product->discount > 0)
                                    <p class="text-[12px] md:text-sm text-red-500">Rp.
                                        {{ number_format($item->product->final_price, 0, ',', '.') }}</p>
                                @else
                                    <p class="text-[12px] md:text-sm text-red-500">Rp.
                                        {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                @endif

                                @php
                                    $sizes = $item->product->size
                                        ? array_map('trim', explode(',', $item->product->size))
                                        : [];
                                @endphp
                                <form action="{{ route('cartStore') }}" method="post"
                                    class="w-full flex flex-col items-center gap-2 mt-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    <div class="flex flex-wrap justify-center gap-1.5 text-[9.5px] md:text-xs">
                                        @foreach ($sizes as $i => $size)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="size" value="{{ $size }}"
                                                    class="peer hidden" {{ $i === 0 ? 'checked' : '' }}>
                                                <span
                                                    class="w-5 h-5 md:w-6 md:h-6 rounded-sm font-medium flex justify-center items-center text-white bg-gray-300 peer-checked:bg-gradient-to-r peer-checked:from-primary peer-checked:to-secondary">{{ strtoupper($size) }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-primary to-secondary text-white text-[11px] md:text-sm font-medium rounded-sm py-2 hover:opacity-90">
                                        <i class="fas fa-cart-shopping"></i> Keranjang
                                    </button>
                                </form>
                                <form action="{{ route('wishlistDestroy', $item->id) }}" method="post" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full border border-red-400 text-red-500 text-[11px] md:text-sm font-medium rounded-sm py-2 hover:bg-red-500 hover:text-white">
                                        <i class="far fa-trash-can"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </section>
@endsection
