@extends('template.layout-main')
@section('title_web', 'Checkout | Hema.Indonesia')
@section('content-main')
    <div id="hero" class="header-hero bg-[#f5f5f5]">
        <div class="container pt-10 pb-11">
            <nav aria-label="breadcrumb" class="w-full">
                <ol class="flex w-full flex-wrap items-center mb-2">
                    <li class="flex items-center text-sm text-gray-500 hover:text-slate-800">
                        <a href="{{ url('/cart') }}">Keranjang</a>
                        <span class="pointer-events-none mx-2 text-slate-800">/</span>
                    </li>
                    <li class="flex items-center text-sm text-gray-500 hover:text-slate-800">
                        <a href="{{ url('/checkout') }}">Checkout</a>
                    </li>
                </ol>
            </nav>
            <h2 class="text-[20px] md:text-2xl font-bold">Checkout <span class="text-primary">Pesanan</span></h2>
            <p class="text-gray-500">Periksa kembali pesanan anda sebelum konfirmasi</p>
        </div>
    </div>

    <section class="container py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 flex flex-col gap-6">
                <div class="border border-gray-200 rounded p-6">
                    <h3 class="font-semibold text-lg mb-4">Alamat Pengiriman</h3>
                    <div class="text-sm text-gray-700 space-y-1">
                        <p><span class="font-medium">Nama:</span> {{ $user->first_name }} {{ $user->last_name }}</p>
                        <p><span class="font-medium">Email:</span> {{ $user->email }}</p>
                        <p><span class="font-medium">No. Telp:</span> {{ $user->no_telp ?? '-' }}</p>
                        <p><span class="font-medium">Alamat:</span> {{ $user->address ?? '-' }}</p>
                    </div>
                    @if (empty($user->address) || empty($user->no_telp))
                        <p class="text-[12px] text-red-500 mt-3">Lengkapi alamat & no. telepon anda di
                            <a href="{{ url('/profile') }}" class="underline font-medium">halaman profil</a> untuk
                            kelancaran pengiriman.
                        </p>
                    @endif
                </div>

                <div class="border border-gray-200 rounded p-6 overflow-x-auto">
                    <h3 class="font-semibold text-lg mb-4">Ringkasan Produk</h3>
                    <table class="w-full text-sm">
                        <thead class="text-left border-b border-gray-200">
                            <tr>
                                <th class="py-2">Produk</th>
                                <th class="py-2">Ukuran</th>
                                <th class="py-2">Harga</th>
                                <th class="py-2">Qty</th>
                                <th class="py-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr class="border-b border-gray-100">
                                    <td class="py-2">
                                        <div class="flex items-center gap-2">
                                            <img class="w-10 h-10 object-cover rounded"
                                                src="{{ asset('uploads/products/' . $item['image']) }}" alt="">
                                            <span>{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-2 uppercase">{{ $item['size'] }}</td>
                                    <td class="py-2">Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td class="py-2">{{ $item['qty'] }}</td>
                                    <td class="py-2">Rp.
                                        {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="border border-gray-200 rounded p-6">
                    <h3 class="font-semibold text-lg mb-4">Total Pembayaran</h3>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-500">Total Item</span>
                        <span>{{ collect($cart)->sum('qty') }}</span>
                    </div>
                    <div class="flex justify-between font-semibold border-t border-gray-200 pt-3 mt-3">
                        <span>Total</span>
                        <span class="text-primary">Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <form action="{{ route('orderStore') }}" method="post" class="mt-6">
                        @csrf
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-primary to-secondary text-white text-sm font-medium rounded-sm py-[10px] hover:opacity-90">
                            Konfirmasi Pesanan
                        </button>
                    </form>
                    <p class="text-[11px] text-gray-400 text-center mt-2">Pesanan dibuat dengan status "Menunggu
                        Pembayaran". Pembayaran online tersedia pada Tahap 4.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
