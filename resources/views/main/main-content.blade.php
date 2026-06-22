@extends('template.layout-main')
@section('title_web', ($data_about->name ?? 'Hema') . '.Indonesia — Gamis Elegan')
@section('content-main')

{{-- ═══ HERO ═══ --}}
<section class="relative overflow-hidden" style="min-height:90vh;background:linear-gradient(135deg,#1e1410 0%,#3d2e26 60%,#5a3e2b 100%);">

    {{-- Background: galeri dari DB (swiper) --}}
    @if($hero_gallery->isNotEmpty())
    <div class="absolute inset-0 z-0">
        <div class="swiper mySwiperHero w-full h-full">
            <div class="swiper-wrapper">
                @foreach($hero_gallery as $g)
                <div class="swiper-slide w-full h-full">
                    <img src="{{ asset('uploads/gallery/'.$g->image) }}"
                         class="w-full h-full object-cover opacity-30" alt="{{ $g->title }}">
                </div>
                @endforeach
            </div>
        </div>
        <div class="absolute inset-0" style="background:linear-gradient(to right,rgba(30,20,16,.80) 0%,rgba(30,20,16,.30) 60%,transparent 100%);"></div>
    </div>
    @endif

    {{-- Content --}}
    <div class="relative z-10 container flex items-center" style="min-height:90vh;">
        <div class="max-w-xl py-24">
            <span class="inline-block text-xs font-bold tracking-[3px] uppercase mb-5"
                  style="color:#c29470;background:rgba(194,148,112,.14);padding:5px 16px;border-radius:50px;">
                {{ $data_about->breadcrumb ?? 'Koleksi Premium 2025' }}
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight mb-5">
                Tampil Anggun &amp;<br>
                <span style="color:#c29470;">Berkelas</span> Setiap Hari
            </h1>
            <p class="text-white/70 text-base mb-8 leading-relaxed max-w-md">
                {{ Str::limit($data_about->about_description_company ?? 'Temukan koleksi gamis premium kami yang dirancang untuk wanita modern yang menghargai keeleganan.', 160) }}
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ url('/product') }}"
                   style="display:inline-flex;align-items:center;gap:8px;
                          background:linear-gradient(135deg,#b17457,#c29470);
                          color:#fff;padding:13px 28px;border-radius:8px;
                          font-weight:700;font-size:14px;text-decoration:none;
                          transition:opacity .2s;"
                   onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                    <i class="fas fa-bag-shopping text-sm"></i> Belanja Sekarang
                </a>
                <a href="{{ url('/about') }}"
                   style="display:inline-flex;align-items:center;gap:8px;
                          background:rgba(255,255,255,.12);
                          color:#fff;padding:13px 28px;border-radius:8px;
                          font-weight:600;font-size:14px;text-decoration:none;
                          border:1.5px solid rgba(255,255,255,.35);backdrop-filter:blur(4px);
                          transition:background .2s;"
                   onmouseover="this.style.background='rgba(255,255,255,.22)'"
                   onmouseout="this.style.background='rgba(255,255,255,.12)'">
                    Tentang Kami <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll hint --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-1 opacity-40">
        <span class="text-white text-xs tracking-widest uppercase">Scroll</span>
        <i class="fas fa-chevron-down text-white text-xs animate-bounce"></i>
    </div>
</section>


{{-- ═══ FEATURE STRIP ═══ --}}
<section style="background:#fff;border-bottom:1px solid #ede3db;">
    <div class="container py-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2">
            @foreach([
                ['fas fa-truck',          'Pengiriman Cepat',   'Ke seluruh Indonesia'],
                ['fas fa-shield-halved',  'Produk Terjamin',    'Kualitas premium'],
                ['fas fa-rotate-left',    'Mudah Return',       '7 hari bebas retur'],
                ['fas fa-headset',        'Layanan 24/7',       'Siap membantu Anda'],
            ] as $f)
            <div class="flex items-center gap-3 p-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
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


{{-- ═══ ABOUT SNIPPET — data dari DB ═══ --}}
<section class="container py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
        <div class="relative">
            @if(!empty($data_about) && $data_about->about_img_company)
                <img src="{{ asset('uploads/about/'.$data_about->about_img_company) }}"
                     class="w-full rounded-2xl object-cover"
                     style="height:420px;border:2px solid #ede3db;" alt="About">
            @else
                <div class="w-full rounded-2xl flex items-center justify-center"
                     style="height:420px;background:linear-gradient(135deg,#faf7f4,#f3ede9);border:2px solid #ede3db;">
                    <div class="text-center">
                        <i class="fas fa-image text-4xl" style="color:#d4a882;opacity:.4;"></i>
                        <p class="text-xs text-gray-400 mt-2">Foto belum tersedia<br>
                           <a href="{{ url('/about-company') }}" style="color:#b17457;">Upload di Admin</a>
                        </p>
                    </div>
                </div>
            @endif

            {{-- Rating badge --}}
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
                @if(!empty($data_about))
                    <span style="color:#b17457;">{{ $data_about->name }}</span>
                @else
                    <span style="color:#b17457;">Hema</span>.Indonesia
                @endif
            </h2>
            <p class="text-gray-600 leading-relaxed mb-6">
                {{ $data_about->about_description_company ?? 'Kami menghadirkan koleksi gamis premium yang menggabungkan keeleganan tradisional dengan sentuhan modern.' }}
            </p>

            {{-- Stats dari DB --}}
            <div class="grid grid-cols-2 gap-4 mb-7">
                <div class="p-4 rounded-xl" style="background:#faf7f4;border:1px solid #ede3db;">
                    <p class="text-2xl font-extrabold mb-0" style="color:#b17457;">{{ $stats['total_products'] }}+</p>
                    <p class="text-xs text-gray-500 mt-1">Produk Aktif</p>
                </div>
                <div class="p-4 rounded-xl" style="background:#faf7f4;border:1px solid #ede3db;">
                    <p class="text-2xl font-extrabold mb-0" style="color:#b17457;">{{ $stats['total_categories'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Kategori Tersedia</p>
                </div>
                <div class="p-4 rounded-xl" style="background:#faf7f4;border:1px solid #ede3db;">
                    <p class="text-2xl font-extrabold mb-0" style="color:#b17457;">5 Tahun</p>
                    <p class="text-xs text-gray-500 mt-1">Pengalaman</p>
                </div>
                <div class="p-4 rounded-xl" style="background:#faf7f4;border:1px solid #ede3db;">
                    <p class="text-2xl font-extrabold mb-0" style="color:#b17457;">100%</p>
                    <p class="text-xs text-gray-500 mt-1">Kualitas Terjamin</p>
                </div>
            </div>

            <a href="{{ url('/product') }}"
               style="background:linear-gradient(135deg,#b17457,#c29470);color:#fff;
                      padding:12px 28px;border-radius:8px;font-weight:700;font-size:14px;
                      text-decoration:none;display:inline-flex;align-items:center;gap:8px;
                      transition:opacity .2s;"
               onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                Lihat Koleksi <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>


{{-- ═══ PRODUK UNGGULAN — dari DB ═══ --}}
@if($featured_products->isNotEmpty())
<section style="background:#faf7f4;border-top:1px solid #ede3db;border-bottom:1px solid #ede3db;">
    <div class="container py-16">
        <div class="text-center mb-10">
            <span class="text-xs font-bold tracking-[2px] uppercase" style="color:#b17457;">Pilihan Terbaik</span>
            <h2 class="text-2xl font-extrabold text-gray-900 mt-1">Produk <span style="color:#b17457;">Unggulan</span></h2>
            <p class="text-gray-500 text-sm mt-2">Koleksi terbaru yang paling diminati pelanggan kami</p>
        </div>

        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6">
            @foreach($featured_products as $product)
            @php
                $sizes = $product->size ? array_map('trim', explode(',', $product->size)) : [];
                $isOut = !is_null($product->stock) && $product->stock <= 0;
            @endphp
            <div class="product-card">
                <div class="product-img relative" style="height:220px;overflow:hidden;">
                    <img class="w-full h-full object-cover"
                         src="{{ asset('uploads/products/'.$product->image) }}"
                         alt="{{ $product->name }}">
                    @if($product->discount > 0)
                        <span class="badge-discount">-{{ $product->discount }}%</span>
                    @endif
                    @auth
                    <form action="{{ route('wishlistStore', $product->id) }}" method="post"
                          class="absolute top-2 right-2 z-10">
                        @csrf
                        <button type="submit"
                                class="w-9 h-9 rounded-full flex items-center justify-center shadow transition-all"
                                style="background:rgba(255,255,255,.9);"
                                onmouseover="this.style.background='#b17457';this.style.color='#fff';"
                                onmouseout="this.style.background='rgba(255,255,255,.9)';this.style.color='';"
                                title="Tambah ke Wishlist">
                            <i class="far fa-heart text-sm"></i>
                        </button>
                    </form>
                    @endauth
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 text-sm leading-tight mb-2">{{ $product->name }}</h3>
                    <p class="text-xs text-gray-400 mb-2">{{ optional($product->categories)->name }}</p>
                    <div class="flex items-center gap-2 flex-wrap mb-3">
                        @if($product->discount > 0)
                            <span class="text-xs text-gray-400 line-through">
                                Rp {{ number_format($product->price,0,',','.') }}
                            </span>
                            <span class="text-sm font-bold" style="color:#b17457;">
                                Rp {{ number_format($product->final_price,0,',','.') }}
                            </span>
                        @else
                            <span class="text-sm font-bold" style="color:#b17457;">
                                Rp {{ number_format($product->price,0,',','.') }}
                            </span>
                        @endif
                    </div>

                    @if($isOut)
                        <span class="badge-out">Stok Habis</span>
                    @else
                        @auth
                        <form action="{{ route('cartStore') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="qty" value="1">
                            <div class="flex flex-wrap gap-1.5 mb-3">
                                @foreach($sizes as $i => $size)
                                <label class="size-label cursor-pointer">
                                    <input type="radio" name="size" value="{{ $size }}" {{ $i===0 ? 'checked' : '' }}>
                                    <span class="size-pill">{{ strtoupper($size) }}</span>
                                </label>
                                @endforeach
                            </div>
                            <button type="submit" class="btn-brand w-full py-2 text-xs rounded-lg">
                                <i class="fas fa-cart-shopping"></i> Tambah Keranjang
                            </button>
                        </form>
                        @else
                        <a href="{{ url('/auth/sign-in') }}" class="btn-brand w-full py-2 text-xs rounded-lg text-center block">
                            <i class="fas fa-cart-shopping"></i> Login untuk Beli
                        </a>
                        @endauth
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ url('/product') }}"
               style="display:inline-flex;align-items:center;gap:8px;
                      border:1.5px solid #b17457;color:#b17457;
                      padding:11px 28px;border-radius:8px;font-weight:600;font-size:14px;
                      text-decoration:none;transition:all .2s;"
               onmouseover="this.style.background='#b17457';this.style.color='#fff';"
               onmouseout="this.style.background='transparent';this.style.color='#b17457';">
                Lihat Semua Produk <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>
@endif


{{-- ═══ GALERI SCROLLING — foto dari DB ═══ --}}
@if($hero_gallery->isNotEmpty())
<section style="overflow:hidden;padding:56px 0;background:#fff;border-bottom:1px solid #ede3db;">
    <div class="container mb-8 text-center">
        <span class="text-xs font-bold tracking-[2px] uppercase" style="color:#b17457;">Galeri</span>
        <h2 class="text-2xl font-extrabold text-gray-900 mt-1">Koleksi <span style="color:#b17457;">Kami</span></h2>
    </div>
    {{-- Auto-scroll strip --}}
    <div class="wrapper-scroll">
        @foreach($hero_gallery as $g)
        <div class="item-scroll">
            <a href="{{ asset('uploads/gallery/'.$g->image) }}" class="image-popup">
                <img src="{{ asset('uploads/gallery/'.$g->image) }}"
                     alt="{{ $g->title }}"
                     style="height:220px;width:280px;object-fit:cover;border-radius:12px;
                            border:1.5px solid #ede3db;">
            </a>
        </div>
        @endforeach
        {{-- Duplikasi untuk efek infinite scroll tanpa JS --}}
        @foreach($hero_gallery as $g)
        <div class="item-scroll" aria-hidden="true">
            <img src="{{ asset('uploads/gallery/'.$g->image) }}"
                 alt=""
                 style="height:220px;width:280px;object-fit:cover;border-radius:12px;
                        border:1.5px solid #ede3db;">
        </div>
        @endforeach
    </div>
</section>
@endif


{{-- ═══ KATEGORI CEPAT ═══ --}}
@if($categories->isNotEmpty())
<section class="container py-14">
    <div class="text-center mb-8">
        <span class="text-xs font-bold tracking-[2px] uppercase" style="color:#b17457;">Koleksi</span>
        <h2 class="text-2xl font-extrabold text-gray-900 mt-1">Jelajahi <span style="color:#b17457;">Kategori</span></h2>
    </div>
    <div class="flex flex-wrap justify-center gap-3">
        <a href="{{ url('/product') }}"
           class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all"
           style="background:linear-gradient(135deg,#b17457,#c29470);color:#fff;text-decoration:none;">
            Semua Produk
        </a>
        @foreach($categories as $cat)
        <a href="{{ url('/product?category='.$cat->category_code) }}"
           class="px-5 py-2.5 rounded-full text-sm font-medium transition-all"
           style="background:#faf7f4;border:1.5px solid #ede3db;color:#3d2e26;text-decoration:none;"
           onmouseover="this.style.borderColor='#b17457';this.style.color='#b17457';"
           onmouseout="this.style.borderColor='#ede3db';this.style.color='#3d2e26';">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>
</section>
@endif


{{-- ═══ SOCIAL MEDIA — dari DB ═══ --}}
@if(!empty($data_about) && ($data_about->instagram || $data_about->tiktok || $data_about->facebook || $data_about->youtube))
<section style="background:#faf7f4;border-top:1px solid #ede3db;border-bottom:1px solid #ede3db;padding:40px 0;">
    <div class="container text-center">
        <p class="text-sm font-semibold text-gray-500 mb-4 uppercase tracking-widest">Ikuti Kami</p>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach([
                ['instagram', 'fab fa-instagram', 'Instagram', '#e1306c'],
                ['tiktok',    'fab fa-tiktok',    'TikTok',    '#000000'],
                ['facebook',  'fab fa-facebook-f','Facebook',  '#1877f2'],
                ['youtube',   'fab fa-youtube',   'YouTube',   '#ff0000'],
            ] as $s)
            @if(!empty($data_about->{$s[0]}))
            <a href="{{ $data_about->{$s[0]} }}" target="_blank" rel="noopener"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all"
               style="background:#fff;border:1.5px solid {{ $s[3] }}22;color:{{ $s[3] }};text-decoration:none;"
               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 14px {{ $s[3] }}33';"
               onmouseout="this.style.transform='';this.style.boxShadow='';">
                <i class="{{ $s[1] }}"></i> {{ $s[2] }}
            </a>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ═══ CTA ═══ --}}
<section class="container py-20">
    <div class="rounded-2xl text-center p-12 relative overflow-hidden"
         style="background:linear-gradient(135deg,#1e1410 0%,#3d2e26 100%);">
        <div class="relative z-10">
            <span class="text-xs font-bold tracking-[2px] uppercase" style="color:#c29470;">
                Penawaran Spesial
            </span>
            <h2 class="text-3xl font-extrabold text-white mt-2 mb-3">Mulai Belanja Sekarang</h2>
            <p class="text-white/60 mb-7 max-w-md mx-auto text-sm">
                Dapatkan koleksi gamis premium terbaru dengan harga terbaik.
            </p>
            <a href="{{ url('/product') }}"
               style="background:linear-gradient(135deg,#b17457,#c29470);color:#fff;
                      padding:13px 34px;border-radius:8px;font-weight:700;font-size:14px;
                      text-decoration:none;display:inline-flex;align-items:center;gap:8px;
                      transition:opacity .2s;"
               onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                <i class="fas fa-bag-shopping"></i> Order Sekarang
            </a>
        </div>
    </div>
</section>

@endsection
