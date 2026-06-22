<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="success" content="{{ session('success') }}">
    <meta name="success_timer" content="{{ session('success_timer') }}">
    <meta name="error" content="{{ session('error') }}">
    <meta name="errors" content='@json($errors->all())'>
    <title>@yield('title_web')</title>

    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/customer.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    <link rel="stylesheet" href="{{ asset('library/swiper/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('library/sweetalert/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('library/preline-ui/variants.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('admin/plugins/lightbox/glightbox.min.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="font-urbanist bg-white text-gray-800">

    {{-- ═══ NAVBAR ═══ --}}
    <header id="navbar" class="w-full left-0 top-0 z-50 transition-all duration-300">
        <nav class="container flex items-center justify-between h-16 sm:h-[68px]">

            {{-- Mobile hamburger --}}
            <div class="xl:hidden cursor-pointer z-50 w-9 h-9 flex items-center justify-center rounded hover:bg-gray-100 transition-colors">
                <i class="fa-solid fa-bars text-gray-700" id="hamburger"></i>
            </div>

            {{-- Logo + nav links --}}
            <div class="flex gap-14 items-center">
                <a href="{{ url('/') }}" class="text-xl font-extrabold tracking-tight shrink-0">
                    <span style="color:#b17457">Hema</span><span class="text-gray-800">.Indonesia</span>
                </a>

                {{-- Off-canvas nav (mobile) --}}
                <div id="nav-menu"
                    class="fixed top-0 left-[-100%] w-[280px] h-full bg-white shadow-2xl flex flex-col p-6 duration-300 z-50
                           xl:static xl:w-auto xl:h-auto xl:shadow-none xl:flex xl:flex-row xl:p-0 xl:items-center xl:gap-8">

                    {{-- Mobile header --}}
                    <div class="flex items-center justify-between mb-8 xl:hidden">
                        <span class="text-lg font-extrabold">
                            <span style="color:#b17457">Hema</span>.Indonesia
                        </span>
                        <button id="close_navbar" class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-100">
                            <i class="fa-solid fa-xmark text-gray-600"></i>
                        </button>
                    </div>

                    <ul class="flex flex-col xl:flex-row xl:items-center xl:gap-1">
                        @php
                            $navLinks = [
                                ['url' => '/',        'label' => 'Beranda'],
                                ['url' => '/product', 'label' => 'Produk'],
                                ['url' => '/orders',  'label' => 'Pesanan'],
                                ['url' => '/about',   'label' => 'Tentang'],
                                ['url' => '/gallery', 'label' => 'Galeri'],
                                ['url' => '/faq',     'label' => 'FAQ'],
                            ];
                        @endphp
                        @foreach($navLinks as $link)
                            @php $active = request()->is(ltrim($link['url'],'/') ?: '/') || request()->url() === url($link['url']); @endphp
                            <li>
                                <a href="{{ url($link['url']) }}"
                                   class="nav-link block px-3 py-2 rounded text-sm font-medium transition-colors
                                          {{ $active ? 'text-[#b17457] font-semibold' : 'text-gray-600 hover:text-[#b17457]' }}">
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Mobile action icons --}}
                    @auth
                    <div class="flex gap-3 mt-6 xl:hidden">
                        <a href="{{ url('/cart') }}" class="nav-icon-btn relative">
                            <i class="fas fa-cart-shopping"></i>
                            @if(!empty($cartCount) && $cartCount > 0)
                                <span class="badge-dot">{{ $cartCount }}</span>
                            @endif
                        </a>
                        <a href="{{ url('/wishlist') }}" class="nav-icon-btn relative">
                            <i class="far fa-heart"></i>
                            @if(!empty($wishlistCount) && $wishlistCount > 0)
                                <span class="badge-dot">{{ $wishlistCount }}</span>
                            @endif
                        </a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="nav-icon-btn" type="submit">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>

            {{-- Desktop right icons --}}
            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ url('/profile') }}" class="nav-icon-btn" title="Profil">
                        <i class="far fa-user"></i>
                    </a>
                    <a href="{{ url('/cart') }}" class="nav-icon-btn relative hidden xl:flex" title="Keranjang">
                        <i class="fas fa-cart-shopping"></i>
                        @if(!empty($cartCount) && $cartCount > 0)
                            <span class="badge-dot">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="{{ url('/wishlist') }}" class="nav-icon-btn relative hidden xl:flex" title="Wishlist">
                        <i class="far fa-heart"></i>
                        @if(!empty($wishlistCount) && $wishlistCount > 0)
                            <span class="badge-dot">{{ $wishlistCount }}</span>
                        @endif
                    </a>
                    <form class="hidden xl:block" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="nav-icon-btn" type="submit" title="Keluar">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ url('/auth/sign-in') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded
                              bg-gradient-to-r from-[#b17457] to-[#c29470] text-white hover:opacity-90 transition-opacity">
                        <i class="far fa-user text-xs"></i>Masuk
                    </a>
                @endauth
            </div>
        </nav>
    </header>
    {{-- /NAVBAR --}}

    {{-- Floating buttons --}}
    <div class="z-40 fixed right-4 lg:right-6 bottom-6 flex flex-col gap-2">
        <a id="scroll-top-btn"
           href="#navbar"
           class="w-10 h-10 hidden bg-white border border-gray-200 text-gray-600 hover:bg-[#b17457] hover:text-white hover:border-[#b17457] rounded-full shadow-md flex items-center justify-center transition-all duration-200"
           title="Ke atas">
            <i class="fas fa-chevron-up text-xs"></i>
        </a>
        <a href="https://wa.me/6281389861954?text=Hallo"
           class="w-10 h-10 bg-white border border-gray-200 text-gray-600 hover:bg-green-500 hover:text-white hover:border-green-500 rounded-full shadow-md flex items-center justify-center transition-all duration-200"
           title="WhatsApp" target="_blank" rel="noopener">
            <i class="fab fa-whatsapp text-lg"></i>
        </a>
    </div>

    @yield('content-main')

    {{-- ═══ FOOTER ═══ --}}
    <footer class="bg-gray-900 text-gray-300 pt-14 pb-8 mt-0">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <a href="{{ url('/') }}" class="text-xl font-extrabold tracking-tight">
                        <span style="color:#c29470">Hema</span><span class="text-white">.Indonesia</span>
                    </a>
                    <p class="text-sm text-gray-400 mt-3 leading-relaxed">
                        Koleksi gamis elegan untuk tampil anggun & berkelas setiap hari.
                    </p>
                    <div class="flex gap-2 mt-5">
                        @foreach([['fab fa-instagram','Instagram'],['fab fa-tiktok','TikTok'],['fab fa-x-twitter','X'],['fab fa-youtube','YouTube']] as $s)
                        <a href="#" title="{{ $s[1] }}"
                           class="w-9 h-9 rounded-full bg-gray-800 hover:bg-[#b17457] flex items-center justify-center text-gray-400 hover:text-white transition-all text-sm">
                            <i class="{{ $s[0] }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Nav links --}}
                <div>
                    <h5 class="text-white font-semibold text-sm mb-4 tracking-wider uppercase">Halaman</h5>
                    <ul class="space-y-2">
                        @foreach([['/','/','Beranda'],['/product','product','Produk'],['/orders','orders','Pesanan'],['/about','about','Tentang'],['/gallery','gallery','Galeri'],['/faq','faq','FAQ']] as $fl)
                        <li>
                            <a href="{{ url($fl[0]) }}"
                               class="text-sm text-gray-400 hover:text-[#c29470] transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>{{ $fl[2] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Account --}}
                <div>
                    <h5 class="text-white font-semibold text-sm mb-4 tracking-wider uppercase">Akun</h5>
                    <ul class="space-y-2">
                        @auth
                        <li>
                            <a href="{{ url('/profile') }}" class="text-sm text-gray-400 hover:text-[#c29470] transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>Profil Saya
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/cart') }}" class="text-sm text-gray-400 hover:text-[#c29470] transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>Keranjang
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/wishlist') }}" class="text-sm text-gray-400 hover:text-[#c29470] transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>Wishlist
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/orders') }}" class="text-sm text-gray-400 hover:text-[#c29470] transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>Pesanan Saya
                            </a>
                        </li>
                        @else
                        <li>
                            <a href="{{ url('/auth/sign-in') }}" class="text-sm text-gray-400 hover:text-[#c29470] transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>Masuk
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/auth/sign-up') }}" class="text-sm text-gray-400 hover:text-[#c29470] transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>Daftar
                            </a>
                        </li>
                        @endauth
                    </ul>
                </div>

                {{-- Newsletter --}}
                <div>
                    <h5 class="text-white font-semibold text-sm mb-4 tracking-wider uppercase">Newsletter</h5>
                    <p class="text-sm text-gray-400 mb-3 leading-relaxed">Dapatkan info produk & promo terbaru langsung di inbox Anda.</p>
                    <form action="{{ route('newsEmailPost') }}" method="post">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <input type="email" name="email"
                                placeholder="Masukkan email anda"
                                class="w-full bg-gray-800 border border-gray-700 text-gray-300 placeholder-gray-500
                                       rounded px-4 py-2.5 text-sm focus:outline-none focus:border-[#b17457] transition-colors">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-[#b17457] to-[#c29470] text-white text-sm font-semibold
                                       rounded px-4 py-2.5 hover:opacity-90 transition-opacity">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} <span style="color:#c29470">Hema</span>.Indonesia — All Rights Reserved
                </p>
                <p class="text-xs text-gray-600">Built with <i class="fas fa-heart text-[#b17457] mx-1"></i> for elegance</p>
            </div>
        </div>
    </footer>
    {{-- /FOOTER --}}

    <script src="{{ asset('library/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('library/magic-grid/magic-grid.min.js') }}"></script>
    <script src="{{ asset('library/preline-ui/preline.js') }}"></script>
    <script src="{{ asset('admin/plugins/lightbox/glightbox.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/lightbox/lightbox.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>

    <script>
    // Mobile nav
    const hamburger = document.getElementById('hamburger');
    const closeNavbar = document.getElementById('close_navbar');
    const navMenu = document.getElementById('nav-menu');
    hamburger?.addEventListener('click', () => { navMenu.classList.add('left-0'); navMenu.classList.remove('left-[-100%]'); });
    closeNavbar?.addEventListener('click', () => { navMenu.classList.remove('left-0'); navMenu.classList.add('left-[-100%]'); });

    // Sticky navbar
    const navbar = document.getElementById('navbar');
    const scrollTopBtn = document.getElementById('scroll-top-btn');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('fixed', 'bg-white', 'shadow-md');
            scrollTopBtn?.classList.remove('hidden');
            scrollTopBtn?.classList.add('flex');
        } else {
            navbar.classList.remove('fixed', 'shadow-md');
            scrollTopBtn?.classList.add('hidden');
            scrollTopBtn?.classList.remove('flex');
        }
    });
    </script>
</body>
</html>
