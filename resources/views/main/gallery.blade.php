@extends('template.layout-main')
@section('title_web', 'Galeri | Hema.Indonesia')
@section('content-main')
    <div class="header-hero bg-[#f5f5f5]">
        <div class="container pt-10 pb-11">
            <div class="block">
                <nav aria-label="breadcrumb" class="w-full">
                    <ol class="flex w-full flex-wrap items-center mb-2">
                        <li
                            class="flex cursor-pointer items-center text-sm text-gray-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="{{ url('/') }}">Beranda</a>
                            <span class="pointer-events-none mx-2 text-slate-800">
                                /
                            </span>
                        </li>
                        <li
                            class="flex cursor-pointer items-center text-sm text-gray-500 transition-colors duration-300 hover:text-slate-800">
                            <a href="{{ url('/gallery') }}">Galeri</a>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-[20px] md:text-2xl font-bold">
                    Galeri | <span class="text-primary">Hema</span>.Indonesia
                </h2>
                <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, id?</p>
            </div>
        </div>
    </div>

    <section class="gallery container py-24">
        <main id="content_gallery" class="content_gallery w-full flex md:gap-[1rem]">
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img class="w-full h-auto" src="{{ asset('images/main/hero-img-1.jpg') }}" alt="">
            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://wallpapersok.com/images/high/hd-nature-phone-foggy-mountain-m1pz478hctll7i2i.webp"
                    alt="https://png.pngtree.com/thumb_back/fh260/back_our/20190619/ourmid/pngtree-simple-natural-green-leaf-h5-illustration-image_132970.jpg">
            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://st2.depositphotos.com/1000276/8912/i/450/depositphotos_89122584-stock-photo-majestic-sunset-in-the-mountains.jpg"
                    alt="" class="w-full h-auto">
            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://st2.depositphotos.com/1000276/8912/i/450/depositphotos_89122584-stock-photo-majestic-sunset-in-the-mountains.jpg"
                    alt="" class="w-full h-auto">
            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://st2.depositphotos.com/1000276/8912/i/450/depositphotos_89122584-stock-photo-majestic-sunset-in-the-mountains.jpg"
                    alt="" class="w-full h-auto">
            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="{{ asset('images/main/hero-img-1.jpg') }}" alt="">
            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://png.pngtree.com/thumb_back/fh260/back_our/20190619/ourmid/pngtree-simple-natural-green-leaf-h5-illustration-image_132970.jpg"
                    alt="" class="w-full h-auto">
            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://st2.depositphotos.com/1000276/8912/i/450/depositphotos_89122584-stock-photo-majestic-sunset-in-the-mountains.jpg"
                    alt="" class="w-full h-auto">

            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://wallpapersok.com/images/high/hd-nature-phone-foggy-mountain-m1pz478hctll7i2i.webp"
                    alt="" class="w-full h-auto">

            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://st2.depositphotos.com/1000276/8912/i/450/depositphotos_89122584-stock-photo-majestic-sunset-in-the-mountains.jpg"
                    alt="" class="w-full h-auto">

            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://png.pngtree.com/thumb_back/fh260/back_our/20190619/ourmid/pngtree-simple-natural-green-leaf-h5-illustration-image_132970.jpg"
                    alt="" class="w-full h-auto">

            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://wallpapersok.com/images/high/hd-nature-phone-foggy-mountain-m1pz478hctll7i2i.webp"
                    alt="" class="w-full h-auto">

            </div>
            <div
                class="xl:w-[calc(100%_/_4_-_1rem)] md:w-[calc(100%_/_3_-_1rem)] w-[calc(100%_/_2_-_1rem)] h-auto flex justify-center items-center rounded-lg">
                <img src="https://png.pngtree.com/thumb_back/fh260/back_our/20190619/ourmid/pngtree-simple-natural-green-leaf-h5-illustration-image_132970.jpg"
                    alt="" class="w-full h-auto">

            </div>
        </main>
    </section>
@endsection
