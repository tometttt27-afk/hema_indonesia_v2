@extends('template.layout-main')
@section('title_web', 'Keranjang | Hema.Indonesia')
@section('content-main')

<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list"><li><a href="{{ url('/') }}">Beranda</a></li><li>Keranjang</li></ol>
        <h2 class="page-hero">Keranjang <span style="color:#b17457;">Belanja</span></h2>
        <p>Tinjau produk sebelum melanjutkan ke pembayaran</p>
    </div>
</div>

<section class="container py-14">
    @if(empty($cart))
        <div class="empty-state max-w-md mx-auto">
            <i class="fas fa-cart-shopping"></i>
            <p>Keranjang Anda masih kosong.</p>
            <a href="{{ url('/product') }}" class="btn-brand mt-4 inline-flex">Mulai Belanja</a>
        </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Cart table --}}
        <div class="lg:col-span-2">
            <div class="rounded-xl overflow-hidden" style="border:1.5px solid #ede3db;background:#fff;">
                <div class="overflow-x-auto">
                    <table class="data-table w-full">
                        <thead><tr>
                            <th>Produk</th><th>Ukuran</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th></th>
                        </tr></thead>
                        <tbody>
                            @foreach($cart as $key => $item)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <img class="rounded-lg object-cover shrink-0"
                                            style="width:56px;height:56px;border:1.5px solid #ede3db;"
                                            src="{{ asset('uploads/products/'.$item['image']) }}" alt="">
                                        <span class="font-semibold text-gray-800 text-sm">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td><span class="badge-out text-xs uppercase px-2 py-1">{{ $item['size'] }}</span></td>
                                <td class="text-gray-600">Rp. {{ number_format($item['price'],0,',','.') }}</td>
                                <td>
                                    <form action="{{ route('cartUpdate',$key) }}" method="post" class="flex items-center gap-2">
                                        @csrf @method('PUT')
                                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                                            class="input-brand text-center" style="width:64px;padding:6px 8px;">
                                        <button type="submit" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors"
                                            style="background:#f3ede9;color:#b17457;" title="Perbarui">
                                            <i class="fas fa-rotate text-xs"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="font-bold" style="color:#b17457;">
                                    Rp. {{ number_format($item['price']*$item['qty'],0,',','.') }}
                                </td>
                                <td>
                                    <form action="{{ route('cartRemove',$key) }}" method="post">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-full flex items-center justify-center transition-colors"
                                            style="background:#fef2f2;color:#ef4444;" title="Hapus">
                                            <i class="far fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4" style="border-top:1px solid #f5ede6;">
                    <form action="{{ route('cartClear') }}" method="post">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-danger-soft text-xs px-4 py-2 confirm-text">
                            <i class="far fa-trash-can"></i> Kosongkan Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Summary --}}
        <div>
            <div class="summary-panel">
                <h3>Ringkasan Belanja</h3>
                <div class="summary-row"><span class="label">Total Item</span><span>{{ collect($cart)->sum('qty') }}</span></div>
                <div class="summary-row"><span class="label">Pengiriman</span><span class="text-xs text-gray-400">Dihitung saat checkout</span></div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span class="amount">Rp. {{ number_format($total,0,',','.') }}</span>
                </div>
                <a href="{{ url('/checkout') }}" class="btn-brand w-full text-center mt-5 py-3 rounded-xl text-sm block">
                    <i class="fas fa-arrow-right text-xs"></i> Lanjut ke Checkout
                </a>
                <a href="{{ url('/product') }}" class="btn-outline-brand w-full text-center mt-2 py-3 rounded-xl text-sm block">
                    Lanjut Belanja
                </a>
            </div>
        </div>
    </div>
    @endif
</section>

@endsection
