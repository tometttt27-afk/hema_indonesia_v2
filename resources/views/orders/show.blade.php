@extends('template.layout-main')
@section('title_web', 'Detail Pesanan | Hema.Indonesia')
@section('content-main')
    @php
        $badge = [
            'pending' => 'bg-yellow-100 text-yellow-700',
            'paid' => 'bg-blue-100 text-blue-700',
            'shipped' => 'bg-indigo-100 text-indigo-700',
            'completed' => 'bg-green-100 text-green-700',
            'cancelled' => 'bg-red-100 text-red-700',
        ];
        $label = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Dibayar',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
    @endphp
    <div id="hero" class="header-hero bg-[#f5f5f5]">
        <div class="container pt-10 pb-11">
            <nav aria-label="breadcrumb" class="w-full">
                <ol class="flex w-full flex-wrap items-center mb-2">
                    <li class="flex items-center text-sm text-gray-500 hover:text-slate-800">
                        <a href="{{ url('/orders') }}">Pesanan</a>
                        <span class="pointer-events-none mx-2 text-slate-800">/</span>
                    </li>
                    <li class="flex items-center text-sm text-gray-500 hover:text-slate-800">
                        <a href="{{ url('/orders/' . $data->id) }}">#{{ $data->id }}</a>
                    </li>
                </ol>
            </nav>
            <div class="flex items-center gap-3">
                <h2 class="text-[20px] md:text-2xl font-bold">Pesanan <span class="text-primary">#{{ $data->id }}</span>
                </h2>
                <span
                    class="text-[11px] px-3 py-1 rounded-full {{ $badge[$data->status] ?? 'bg-gray-100 text-gray-700' }}">{{ $label[$data->status] ?? $data->status }}</span>
            </div>
            <p class="text-gray-500">Dibuat {{ $data->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <section class="container py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 border border-gray-200 rounded p-6 overflow-x-auto">
                <h3 class="font-semibold text-lg mb-4">Produk Dipesan</h3>
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
                        @foreach ($data->details as $detail)
                            <tr class="border-b border-gray-100">
                                <td class="py-2">
                                    <div class="flex items-center gap-2">
                                        <img class="w-10 h-10 object-cover rounded"
                                            src="{{ asset('uploads/products/' . optional($detail->product)->image) }}"
                                            alt="">
                                        <span>{{ optional($detail->product)->name ?? 'Produk dihapus' }}</span>
                                    </div>
                                </td>
                                <td class="py-2 uppercase">{{ $detail->size }}</td>
                                <td class="py-2">Rp. {{ number_format($detail->price, 0, ',', '.') }}</td>
                                <td class="py-2">{{ $detail->quantity }}</td>
                                <td class="py-2">Rp.
                                    {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="lg:col-span-1">
                <div class="border border-gray-200 rounded p-6">
                    <h3 class="font-semibold text-lg mb-4">Ringkasan</h3>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-500">Total Item</span>
                        <span>{{ $data->details->sum('quantity') }}</span>
                    </div>
                    <div class="flex justify-between font-semibold border-t border-gray-200 pt-3 mt-3">
                        <span>Total</span>
                        <span class="text-primary">Rp. {{ number_format($data->total_price, 0, ',', '.') }}</span>
                    </div>

                    @if (in_array($data->status, ['pending', 'paid']))
                        <form action="{{ route('orderCancel', $data->id) }}" method="post" class="mt-6">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="confirm-text w-full border border-red-400 text-red-500 text-sm font-medium rounded-sm py-[10px] hover:bg-red-500 hover:text-white">
                                Batalkan Pesanan
                            </button>
                        </form>
                    @endif

                    @if ($data->status === 'shipped')
                        <form action="{{ route('orderComplete', $data->id) }}" method="post" class="mt-3">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-primary to-secondary text-white text-sm font-medium rounded-sm py-[10px] hover:opacity-90">
                                Konfirmasi Pesanan Diterima
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
