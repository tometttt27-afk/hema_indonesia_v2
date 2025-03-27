@extends('template.layout-main')
@section('title_web', 'Hema.Indonesia')
@section('content-main')
    <section id="hero" class="hero relative w-full h-[80dvh] lg:h-[60dvh] bg-[#f5f5f5] flex xl:flex-row flex-col">
        <main class="flex-1 swiper mySwiperHero w-full">
            <div class="swiper-wrapper">
                <div class="swiper-slide w-full">
                    <img src="{{ asset('images/main/hero-img-1.jpg') }}" class="w-full h-full" alt="Hero Img 1" />
                </div>
                <div class="swiper-slide w-full">
                    <img src="{{ asset('images/main/hero-img-1.jpg') }}" class="w-full h-full" alt="Hero Img 1" />
                </div>
                <div class="swiper-slide w-full">
                    <img src="{{ asset('images/main/hero-img-1.jpg') }}" class="w-full h-full" alt="Hero Img 1" />
                </div>
            </div>
            <!-- <div class="swiper-pagination"></div> -->
            <div class="container">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </main>
        <main class="flex-1 flex items-center p-8">
            <div class="">
                <h2 class="text-3xl text-gray-800 font-bold">
                    Selamat Datang di Hema Indonesia
                </h2>
                <h3 class="text-gray-500 text-lg font-medium">
                    Temukan Koleksi Gamis Elegan untuk Tampil Anggun & Berkelas!
                </h3>
                <a href=""
                    class="text-sm tracking-wider inline-block cursor-pointer mt-3 px-4 py-[8px] hover:bg-black rounded-sm hover:text-white border-[1.5px] border-black">Beli
                    Sekarang</a>
            </div>
        </main>
    </section>


    <section class="about container py-24">
        <main class="content flex flex-col md:flex-row bg-[#f7f7f7]">
            <div class="flex-1 flex items-start flex-col justify-center p-10">
                <h2 class="text-2xl mb-1 font-bold">
                    <span class="text-primary">Hema</span>.Indonesia
                </h2>
                <p class="text-justify text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor officia
                    error quam dolores pariatur quia ratione velit. Consequatur, provident! Quod soluta sed eum quasi
                    tempore eius repellat. Iste, autem voluptatibus! Ut quidem culpa corrupti architecto repudiandae, saepe
                    nam totam excepturi esse, nihil aut. Impedit quae doloribus illum commodi, incidunt sapiente.</p>
            </div>
            <div class="flex-1">
                <img class="w-full h-[300px] object-cover" src="{{ asset('images/not-found/not-photo.png') }}"
                    alt="">
            </div>
        </main>
        <a href="" id="drop_product_btn" class="w-full flex justify-center items-center mt-6">
            <i class="fa-solid fa-chevron-down bg-white shadow p-3 rounded hover:bg-black hover:text-white"></i>
        </a>
    </section>


    <section class="container pt-12 pb-24">
        <div class="wrapper-scroll">
            <div class="item-scroll" id="item-1">
                <img src="{{ asset('images/not-found/not-photo.jpg') }}" alt="Gallery 1">
            </div>
            <div class="item-scroll" id="item-2">
                <img src="{{ asset('images/not-found/not-photo.jpg') }}" alt="Gallery 2">
            </div>
            <div class="item-scroll" id="item-3">
                <img src="{{ asset('images/not-found/not-photo.jpg') }}" alt="Gallery 3">
            </div>
            <div class="item-scroll" id="item-4">
                <img src="{{ asset('images/not-found/not-photo.jpg') }}" alt="Gallery 4">
            </div>
            <div class="item-scroll" id="item-5">
                <img src="{{ asset('images/not-found/not-photo.jpg') }}" alt="Gallery 5">
            </div>
            <div class="item-scroll" id="item-6">
                <img src="{{ asset('images/not-found/not-photo.jpg') }}" alt="Gallery 6">
            </div>
            <div class="item-scroll" id="item-7">
                <img src="{{ asset('images/not-found/not-photo.jpg') }}" alt="Gallery 7">
            </div>
        </div>
    </section>


    <section class="contact container pt-12 pb-36">
        <main class="content flex flex-col justify-center items-center text-center">
            <h2 class="font-bold text-xl">Lorem ipsum, dolor sit amet consectetur adipisicing elit?</h2>
            <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. sunt voluptates repellendus aperiam
                maxime saepe?</p>
            <a href=""
                class="text-sm bg-gradient-to-r from-primary to-secondary hover:opacity-90 rounded-sm font-medium tracking-widest inline-block mt-3 px-4 py-[10px] outline-none text-white">
                <i class="fa-solid fa-bag-shopping"></i> Order Sekarang
            </a>
        </main>
    </section>
@endsection
