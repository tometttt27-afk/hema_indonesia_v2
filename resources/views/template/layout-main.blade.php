<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="success" content="{{ session('success') }}">
    <meta name="success_timer" content="{{ session('success_timer') }}">
    <meta name="error" content="{{ session('error') }}">
    <meta name="errors" content='@json($errors->all())'>
    <title>@yield('title_web')</title>
    {{-- main css --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    {{-- font urbanist --}}
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset('library/swiper/swiper-bundle.min.css') }}" />
    <!-- sweetalert css -->
    <link rel="stylesheet" href="{{ asset('library/sweetalert/sweetalert2.min.css') }}" />
    <!-- preline-ui css -->
    <link rel="stylesheet" href="{{ asset('library/preline-ui/variants.css') }}" />
    <!-- link font icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('admin/plugins/lightbox/glightbox.min.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="font-urbanist">
    <!-- header and navbar menu -->
    <header id="navbar" class="w-full left-0 top-0 z-50 shadow-sm border-b-[0.5px] border-gray-200">
        <nav class="container flex items-center justify-between h-16 sm:h-20">
            <div class="text-lg sm:2xl cursor-pointer z-50 xl:hidden">
                <i class="fa-solid fa-bars-staggered" id="hamburger"></i>
            </div>
            <div class="flex gap-16 items-center">
                <a href="{{ url('/') }}" class="text-xl sm:text-2xl font-bold">
                    <span class="text-primary">Hema</span>.Indonesia
                </a>
                <div id="nav-menu"
                    class="absolute top-0 left-[-100%] w-full min-h-[100vh] bg-white flex items-start justify-start p-6 xl:p-0 duration-300 z-50 overflow-hidden xl:static xl:min-h-fit xl:w-auto">
                    <ul class="flex flex-col w-full xl:items-center xl:gap-6 xl:flex-row">
                        <h5 class="font-bold xl:hidden text-lg inline-block absolute top-6 left-6">
                            <span class="text-primary">Hema</span>.Indonesia
                        </h5>
                        <div class="text-lg sm:2xl cursor-pointer z-50 xl:hidden inline-block absolute top-6 right-6">
                            <i class="fa-solid fa-x" id="close_navbar"></i>
                        </div>
                        <li class="mt-20 xl:mt-0 border-b-[0.5px] border-gray-300 xl:border-none w-full py-4"><a
                                href="{{ url('/') }}" class="nav-link">Beranda</a></li>
                        <li class="border-b-[0.5px] border-gray-300 xl:border-none w-full py-4">
                            <a href="{{ url('/product') }}" class="nav-link">Produk</a>
                        </li>
                        <li class="border-b-[0.5px] border-gray-300 xl:border-none w-full py-4"><a
                                href="{{ url('/orders') }}" class="nav-link">Pesanan</a></li>
                        <li class="border-b-[0.5px] border-gray-300 xl:border-none w-full py-4 outline-none">
                            <a href="{{ url('/about') }}" class="nav-link">Tentang</a>
                        </li>
                        <li class="border-b-[0.5px] border-gray-300 xl:border-none w-full py-4"><a
                                href="{{ url('/gallery') }}" class="nav-link">Galeri</a></li>
                        <li class="border-b-[0.5px] border-gray-300 xl:border-none w-full py-4"><a
                                href="{{ url('/faq') }}" class="nav-link">FAQ</a></li>
                        <li class="w-full inline-block mt-6 py-4">
                            <div class="text-lg sm:2xl xl:hidden cursor-pointer z-10 flex gap-4">
                                @if (auth()->check())
                                    <a class="w-10 h-10 text-sm flex justify-center items-center bg-gradient-to-r from-primary to-secondary text-white rounded relative"
                                        href="{{ url('/cart') }}"><i class="fas fa-cart-shopping"></i>
                                        @if (!empty($cartCount) && $cartCount > 0)
                                            <span
                                                class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-semibold rounded-full w-4 h-4 flex items-center justify-center">{{ $cartCount }}</span>
                                        @endif
                                    </a>
                                    <a class="w-10 h-10 text-sm flex justify-center items-center bg-gradient-to-r from-primary to-secondary text-white rounded relative"
                                        href="{{ url('/wishlist') }}"><i class="far fa-heart"></i>
                                        @if (!empty($wishlistCount) && $wishlistCount > 0)
                                            <span
                                                class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-semibold rounded-full w-4 h-4 flex items-center justify-center">{{ $wishlistCount }}</span>
                                        @endif
                                    </a>
                                    <form
                                        class="w-10 h-10 text-sm flex justify-center items-center bg-gradient-to-r from-primary to-secondary text-white rounded"
                                        action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="text-lg sm:2xl cursor-pointer z-10 flex gap-5">
                @if (auth()->check())
                    <a href="{{ url('/profile') }}"><i class="far fa-user"></i></a>
                    <a class="hidden xl:inline-block relative" href="{{ url('/cart') }}"><i
                            class="fas fa-cart-shopping"></i>
                        @if (!empty($cartCount) && $cartCount > 0)
                            <span
                                class="absolute -top-2 -right-2 bg-primary text-white text-[10px] font-semibold rounded-full w-4 h-4 flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a class="hidden xl:inline-block relative" href="{{ url('/wishlist') }}"><i
                            class="far fa-heart"></i>
                        @if (!empty($wishlistCount) && $wishlistCount > 0)
                            <span
                                class="absolute -top-2 -right-2 bg-primary text-white text-[10px] font-semibold rounded-full w-4 h-4 flex items-center justify-center">{{ $wishlistCount }}</span>
                        @endif
                    </a>
                    <form class="hidden xl:inline-block" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
                    </form>
                @else
                    <a href="{{ url('/auth/sign-in') }}"><i class="far fa-user"></i></a>
                @endif
            </div>
        </nav>
    </header>

    <div class="z-10 fixed right-[5%] lg:right-[3%] xl:right-[2%] bottom-[5%] flex flex-col gap-2">
        <!-- scroll up -->
        <a href="#hero"
            class="scroll_up_box text-gray-700 hover:bg-black hover:text-white rounded bg-white w-10 h-10 hidden duration-300 justify-center items-center border border-gray-200">
            <i class="fas fa-chevron-up"></i>
        </a>
        <!-- whatsapp -->
        <a href="https://wa.me/6281389861954?text=Hallo"
            class="whatsapp-box text-xl text-gray-700 hover:bg-black hover:text-white rounded bg-white w-10 h-10 duration-300 flex justify-center items-center border border-gray-200">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    @yield('content-main')

    <footer class="pt-10 pb-8 shadow border-t-[0.5px] border-gray-200">
        <main class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-24 md:gap-14 mb-4">
                <div class="block">
                    <h4 class="font-semibold mb-2">
                        <span class="text-primary">Hema</span>.Indonesia
                    </h4>
                    <p class="text-sm text-justify">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi
                        aperiam fugit eos repellat distinctio consequatur ad cumque, nisi
                        architecto laudantium numquam nesciunt. Soluta aspernatur iste sed
                        maiores optio dicta a!
                    </p>
                </div>
                <div class="block">
                    <h4 class="font-medium mb-2">Permalinks</h4>
                    <div class="flex gap-2 flex-col text-sm">
                        <a href="{{ url('/') }}" class="nav-link hover:translate-x-1 duration-300">Beranda</a>
                        <a href="{{ url('/product') }}" class="nav-link hover:translate-x-1 duration-300">Produk</a>
                        <a href="{{ url('/orders') }}" class="nav-link hover:translate-x-1 duration-300">Pesanan</a>
                        <a href="{{ url('/about') }}" class="nav-link hover:translate-x-1 duration-300">Tentang</a>
                        <a href="{{ url('/gallery') }}" class="nav-link hover:translate-x-1 duration-300">Galeri</a>
                        <a href="{{ url('/faq') }}" class="nav-link hover:translate-x-1 duration-300">FAQ</a>
                    </div>
                </div>
                <div class="block">
                    <h4 class="font-medium mb-2">News Letter</h4>
                    <p class="text-sm">Subscribe to receive updates, access to exclusive deals, and more.</p>
                    <form action="{{ route('newsEmailPost') }}" method="post" class="block text-sm mt-3">
                        @csrf
                        <input type="text" autocomplete="off"
                            class="w-full border-[1.5px] rounded-sm border-gray-600 focus:border-primary px-4 py-[10px] outline-none"
                            name="email" id="email" placeholder="E-mail">
                        <button
                            class="bg-gradient-to-r from-primary to-secondary hover:opacity-90 rounded-sm font-medium tracking-widest inline-block mt-3 px-4 py-[10px] outline-none text-white"
                            type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            </div>

            <div class="social-media mt-10 md:mt-6 flex gap-3">
                <a href="" title="Instagram"
                    class="w-9 h-9 flex justify-center items-center hover:bg-primary shadow hover:shadow-none hover:text-white rounded">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" title="Tiktok"
                    class="w-9 h-9 flex justify-center items-center hover:bg-primary shadow hover:shadow-none hover:text-white rounded">
                    <i class="fab fa-tiktok"></i>
                </a>
                <a href="" title="X"
                    class="w-9 h-9 flex justify-center items-center hover:bg-primary shadow hover:shadow-none hover:text-white rounded">
                    <i class="fab fa-x-twitter"></i>
                </a>
                <a href="" title="Youtube"
                    class="w-9 h-9 flex justify-center items-center hover:bg-primary shadow hover:shadow-none hover:text-white rounded">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
            <p class="text-sm mt-8">
                &copy; 2025 - <span class="text-primary">Hema</span>.Indonesia | All Rights Reserved
            </p>
        </main>
    </footer>

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
        const hamburger = document.getElementById("hamburger");
        const closeNavbar = document.getElementById("close_navbar");
        const navMenu = document.getElementById("nav-menu");
        const navLink = document.querySelectorAll(".nav-link");

        hamburger.addEventListener("click", () => {
            navMenu.classList.add("left-[0]");
            navMenu.classList.remove("left-[-100%]");
        });

        closeNavbar.addEventListener("click", () => {
            navMenu.classList.add("left-[-100%]");
            navMenu.classList.remove("left-[0]");
        });
    </script>
</body>

</html>
