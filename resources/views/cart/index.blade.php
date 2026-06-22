@extends('template.layout-main')
@section('title_web', 'Keranjang | Hema.Indonesia')
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
                        <a href="{{ url('/cart') }}">Keranjang</a>
                    </li>
                </ol>
            </nav>
            <h2 class="text-[20px] md:text-2xl font-bold">Keranjang <span class="text-primary">Belanja</span></h2>
            <p class="text-gray-500">Tinjau produk sebelum melanjutkan ke pembayaran</p>
        </div>
    </div>

    <section class="container py-16">
        @if (empty($cart))
            <div class="text-center py-20 border border-gray-200 rounded">
                <i class="fas fa-cart-shopping text-4xl text-gray-300"></i>
                <p class="mt-4 text-gray-500">Keranjang anda masih kosong.</p>
                <a href="{{ url('/product') }}"
                    class="inline-block mt-4 bg-gradient-to-r from-primary to-secondary text-white text-sm font-medium rounded-sm px-6 py-[10px] hover:opacity-90">Mulai
                    Belanja</a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 overflow-x-auto">
                    <table class="w-full text-sm border border-gray-200">
                        <thead class="bg-[#f5f5f5] text-left">
                            <tr>
                                <th class="p-3">Produk</th>
                                <th class="p-3">Ukuran</th>
                                <th class="p-3">Harga</th>
                                <th class="p-3 w-32">Jumlah</th>
                                <th class="p-3">Subtotal</th>
                                <th class="p-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $key => $item)
                                <tr class="border-t border-gray-200">
                                    <td class="p-3">
                                        <div class="flex items-center gap-3">
                                            <img class="w-14 h-14 object-cover rounded"
                                                src="{{ asset('uploads/products/' . $item['image']) }}" alt="">
                                            <span class="font-medium">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="p-3 uppercase">{{ $item['size'] }}</td>
                                    <td class="p-3">Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td class="p-3">
                                        <form action="{{ route('cartUpdate', $key) }}" method="post"
                                            class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                                                class="w-16 border-[1.5px] border-gray-400 focus:border-primary rounded-sm px-2 py-1 outline-none">
                                            <button type="submit" title="Perbarui"
                                                class="text-primary hover:text-secondary"><i
                                                    class="fas fa-rotate"></i></button>
                                        </form>
                                    </td>
                                    <td class="p-3 font-medium">Rp.
                                        {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                                    <td class="p-3">
                                        <form action="{{ route('cartRemove', $key) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus"
                                                class="text-red-500 hover:text-red-700"><i
                                                    class="far fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form action="{{ route('cartClear') }}" method="post" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-sm border border-red-400 text-red-500 rounded-sm px-4 py-2 hover:bg-red-500 hover:text-white">
                            <i class="far fa-trash-can"></i> Kosongkan Keranjang
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-1">
                    <div class="border border-gray-200 rounded p-6">
                        <h3 class="font-semibold text-lg mb-4">Ringkasan Belanja</h3>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-500">Total Item</span>
                            <span>{{ collect($cart)->sum('qty') }}</span>
                        </div>
                        <div class="flex justify-between font-semibold border-t border-gray-200 pt-3 mt-3">
                            <span>Total</span>
                            <span class="text-primary">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <button type="button" disabled
                            class="w-full mt-6 bg-gradient-to-r from-primary to-secondary text-white text-sm font-medium rounded-sm py-[10px] opacity-60 cursor-not-allowed">
                            Checkout (Segera Hadir)
                        </button>
                        <p class="text-[11px] text-gray-400 text-center mt-2">Fitur checkout akan tersedia pada Tahap 3.</p>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
