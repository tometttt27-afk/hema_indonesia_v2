@extends('template.layout-main')
@section('title_web', 'Wishlist | Hema.Indonesia')
@section('content-main')

<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list"><li><a href="{{ url('/') }}">Beranda</a></li><li>Wishlist</li></ol>
        <h2 class="page-hero">Wishlist <span style="color:#b17457;">Saya</span></h2>
        <p>Produk favorit yang Anda simpan</p>
    </div>
</div>

<section class="container py-14">
    @if($data->isEmpty())
        <div class="empty-state max-w-md mx-auto">
            <i class="far fa-heart"></i>
            <p>Wishlist Anda masih kosong.</p>
            <a href="{{ url('/product') }}" class="btn-brand mt-4 inline-flex">Jelajahi Produk</a>
        </div>
    @else
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 md:gap-5">
            @foreach($data as $item)
            @if($item->product)
            <div class="product-card">
                <div class="product-img" style="height:200px;overflow:hidden;">
                    <a href="{{ url('/product') }}">
                        <img class="w-full h-full object-cover"
                            src="{{ asset('uploads/products/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                    </a>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 text-sm mb-2">{{ $item->product->name }}</h3>
                    <p class="text-sm font-bold mb-3" style="color:#b17457;">
                        @if($item->product->discount > 0)
                            Rp. {{ number_format($item->product->final_price,0,',','.') }}
                        @else
                            Rp. {{ number_format($item->product->price,0,',','.') }}
                        @endif
                    </p>
                    @php $sizes = $item->product->size ? array_map('trim',explode(',',$item->product->size)) : []; @endphp
                    <form action="{{ route('cartStore') }}" method="post" class="mb-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                        <input type="hidden" name="qty" value="1">
                        <div class="flex flex-wrap gap-1.5 mb-3">
                            @foreach($sizes as $i => $size)
                            <label class="size-label cursor-pointer">
                                <input type="radio" name="size" value="{{ $size }}" {{ $i===0?'checked':'' }}>
                                <span class="size-pill">{{ strtoupper($size) }}</span>
                            </label>
                            @endforeach
                        </div>
                        <button type="submit" class="btn-brand w-full py-2 text-xs rounded-lg">
                            <i class="fas fa-cart-shopping"></i> Keranjang
                        </button>
                    </form>
                    <form action="{{ route('wishlistDestroy',$item->id) }}" method="post">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-danger-soft w-full py-2 text-xs rounded-lg confirm-text">
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
