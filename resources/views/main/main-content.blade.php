@extends('template.layout-main')
@section('title_web', 'Hema.Indonesia — Gamis Elegan')
@section('content-main')

{{-- ═══ HERO ═══ --}}
<section id="hero" class="relative overflow-hidden bg-[#faf7f4]" style="min-height:88vh;">
    <div class="absolute inset-0 z-0">
        <div class="swiper mySwiperHero w-full h-full">
            <div class="swiper-wrapper">
                @for($i=0;$i<3;$i++)
                <div class="swiper-slide w-full h-full">
                    <img src="{{ asset('images/main/hero-img-1.jpg') }}" class="w-full h-full object-cover" alt="Hero">
                    <div class="absolute inset-0" style="background:linear-gradient(to right,rgba(30,20,16,.65) 0%,rgba(30,20,16,.1) 60%,transparent 100%);"></div>
                </div>
                @endfor
            </div>
            <div class="container">
                <div class="swiper-button-prev" style="color:#c29470;"></div>
                <div class="swiper-button-next" style="color:#c29470;"></div>
            </div>
        </div>
    </div>

    <div class="relative z-10 container flex items-center" style="min-height:88vh;">
        <div class="max-w-xl py-20">
            <span class="inline-block text-xs font-bold tracking-[3px] uppercase mb-4"
                style="color:#c29470;background:rgba(194,148,112,.12);padding:5px 14px;border-radius:50px;">
                Koleksi Terbaru 2025
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight mb-4">
                Tampil Anggun &amp;<br>
                <span style="color:#c29470;">Berkelas</span> Setiap Hari
            </h1>
            <p class="text-white/75 text-base mb-8 leading-relaxed">
                Temukan koleksi gamis premium kami yang dirancang untuk wanita modern yang menghargai keeleganan.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ url('/product') }}"
                   class="btn-brand inline-flex items-center gap-2 px-7 py-3 text-sm font-bold rounded-lg"
                   style="background:linear-gradient(135deg,#b17457,#c29470);color:#fff;text-decoration:none;">
                    <i class="fas fa-bag-shopping"></i> Belanja Sekarang
                </a>
                <a href="{{ url('/about') }}"
                   class="inline-flex items-center gap-2 px-7 py-3 text-sm font-bold rounded-lg"
                   style="background:rgba(255,255,255,.15);color:#fff;border:1.5px solid rgba(255,255,255,.4);backdrop-filter:blur(4px);text-decoration:none;transition:background .2s;"
                   onmouseover="this.style.background='rgba(255,255,255,.25)'"
                   onmouseout="this.style.background='rgba(255,255,255,.15)'">
                    Tentang Kami <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ FEATURE STRIP ═══ --}}
<section class="border-y" style="background:#fff;border-color:#ede3db;">
    <div class="container py-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['fas fa-truck','Pengiriman Cepat','Ke seluruh Indonesia'],
                ['fas fa-shield-halved','Produk Terjamin','Kualitas premium'],
                ['fas fa-rotate-left','Mudah Return','7 hari bebas retur'],
                ['fas fa-headset','Layanan 24/7','Siap membantu Anda'],
            ] as $f)
            <div class="flex items-center gap-3 p-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0"
                    style="background:rgba(177,116,87,.1);">
                    <i class="{{ $f[0] }}" style="color:#b17457;font-size:16px;"></i>
                </div>
                <div>
                    <p class="font-bold text-sm text-gray-800 leading-tight">{{ $f[1] }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $f[2] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ ABOUT SNIPPET ═══ --}}
<section class="container py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="relative">
            <img src="{{ asset('images/not-found/not-photo.png') }}"
                class="w-full rounded-2xl object-cover"
                style="height:420px;border:3px solid #ede3db;" alt="About">
            <div class="absolute -bottom-4 -right-4 hidden lg:flex items-center gap-3 bg-white rounded-xl shadow-lg p-4"
                style="border:1px solid #ede3db;">
                <div class="w-12 h-12 rounded-full flex items-center justify-center"
                    style="background:linear-gradient(135deg,#b17457,#c29470);">
                    <i class="fas fa-star text-white text-base"></i>
                </div>
                <div>
                    <p class="font-bold text-sm text-gray-800">5.0 Rating</p>
                    <p class="text-xs text-gray-500">1000+ Pelanggan Puas</p>
                </div>
            </div>
        </div>
        <div>
            <span class="text-xs font-bold tracking-[2px] uppercase" style="color:#b17457;">Tentang Kami</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2 mb-4">
                <span style="color:#b17457;">Hema</span>.Indonesia<br>
                <span class="text-gray-700">Keindahan dalam Setiap Jahitan</span>
            </h2>
            <p class="text-gray-600 leading-relaxed mb-6">
                Kami menghadirkan koleksi gamis premium yang menggabungkan keeleganan tradisional dengan sentuhan modern.
                Setiap produk dibuat dengan bahan pilihan dan perhatian penuh terhadap detail.
            </p>
            <div class="grid grid-cols-2 gap-4 mb-7">
                @foreach([['500+','Desain Eksklusif'],['10K+','Pelanggan Setia'],['5 Tahun','Pengalaman'],['100%','Kualitas Terjamin']] as $st)
                <div class="p-4 rounded-xl" style="background:#faf7f4;border:1px solid #ede3db;">
                    <p class="text-2xl font-extrabold mb-0" style="color:#b17457;">{{ $st[0] }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $st[1] }}</p>
                </div>
                @endforeach
            </div>
            <a href="{{ url('/product') }}"
               style="background:linear-gradient(135deg,#b17457,#c29470);color:#fff;padding:12px 28px;border-radius:8px;font-weight:700;font-size:14px;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                Lihat Koleksi <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>

{{-- ═══ SCROLLING GALLERY ═══ --}}
<section style="background:#faf7f4;padding:60px 0;overflow:hidden;border-top:1px solid #ede3db;border-bottom:1px solid #ede3db;">
    <div class="container mb-8 text-center">
        <span class="text-xs font-bold tracking-[2px] uppercase" style="color:#b17457;">Galeri</span>
        <h2 class="text-2xl font-extrabold text-gray-900 mt-1">Koleksi Kami</h2>
    </div>
    <div class="wrapper-scroll">
        @for($i=1;$i<=7;$i++)
        <div class="item-scroll" id="item-{{ $i }}">
            <img src="{{ asset('images/not-found/not-photo.jpg') }}" alt="Gallery {{ $i }}" style="border-radius:10px;">
        </div>
        @endfor
    </div>
</section>

{{-- ═══ CTA ═══ --}}
<section class="container py-20">
    <div class="rounded-2xl text-center p-12 relative overflow-hidden"
        style="background:linear-gradient(135deg,#1e1410 0%,#3d2e26 100%);">
        <div class="absolute inset-0 opacity-5" style="background-image:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2260%22 height=%2260%22><circle cx=%2230%22 cy=%2230%22 r=%221%22 fill=%22white%22/></svg>');"></div>
        <div class="relative z-10">
            <span class="text-xs font-bold tracking-[2px] uppercase" style="color:#c29470;">Penawaran Spesial</span>
            <h2 class="text-3xl font-extrabold text-white mt-2 mb-3">Mulai Belanja Sekarang</h2>
            <p class="text-white/60 mb-7 max-w-md mx-auto">Dapatkan koleksi gamis premium terbaru dengan harga terbaik. Gratis ongkir untuk setiap pembelian!</p>
            <a href="{{ url('/product') }}"
               style="background:linear-gradient(135deg,#b17457,#c29470);color:#fff;padding:13px 34px;border-radius:8px;font-weight:700;font-size:14px;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                <i class="fas fa-bag-shopping"></i> Order Sekarang
            </a>
        </div>
    </div>
</section>

@endsection
