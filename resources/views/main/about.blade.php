@extends('template.layout-main')
@section('title_web', 'Tentang | Hema.Indonesia')
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
                            <a href="{{ url('/about') }}">Tentang</a>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-[20px] md:text-2xl font-bold">
                    Tentang <span class="text-primary">{{ $data_about->name ?? 'Hema' }}</span>.Indonesia
                </h2>
                <p class="text-gray-500">{{ $data_about->breadcrumb ?? 'Tentang perusahaan kami' }}</p>
            </div>
        </div>
    </div>

    <section class="about container py-24">
        <main class="content flex w-full gap-10 items-center flex-col-reverse xl:flex-row">
            <div class="flex-1">
                <p class="text-justify">{{ $data_about->about_description_company ?? 'Deskripsi perusahaan belum tersedia.' }}</p>
            </div>
            <div class="flex-1">
                <img class="w-full object-cover h-[250px] md:h-[280px] lg:h-[350px]"
                    src="{{ $data_about && $data_about->about_img_company ? asset('uploads/about/' . $data_about->about_img_company) : asset('images/not-found/not-photo.jpg') }}"
                    alt="">

            </div>
        </main>
        <div class="social-media mt-10 md:mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <a href="{{ $data_about->instagram ?? '#' }}" target="_blank"
                class="w-full h-16 flex gap-3 justify-center items-center hover:bg-primary border-[0.5px] border-gray-200 shadow hover:shadow-none hover:text-white rounded">
                <i class="fab fa-instagram"></i> Instagram
            </a>
            <a href="{{ $data_about->tiktok ?? '#' }}" target="_blank"
                class="w-full h-16 flex gap-3 justify-center items-center hover:bg-primary border-[0.5px] border-gray-200 shadow hover:shadow-none hover:text-white rounded">
                <i class="fab fa-tiktok"></i> Tiktok
            </a>
            <a href="{{ $data_about->facebook ?? '#' }}" target="_blank"
                class="w-full h-16 flex gap-3 justify-center items-center hover:bg-primary border-[0.5px] border-gray-200 shadow hover:shadow-none hover:text-white rounded">
                <i class="fab fa-facebook-f"></i> Facebook
            </a>
            <a href="{{ $data_about->youtube ?? '#' }}" target="_blank"
                class="w-full h-16 flex gap-3 justify-center items-center hover:bg-primary border-[0.5px] border-gray-200 shadow hover:shadow-none hover:text-white rounded">
                <i class="fab fa-youtube"></i> Youtube
            </a>
        </div>
    </section>
@endsection
