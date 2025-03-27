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
                    Tentang <span class="text-primary">Hema</span>.Indonesia
                </h2>
                <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, id?</p>
            </div>
        </div>
    </div>

    <section class="about container py-24">
        <main class="content flex w-full gap-10 items-center flex-col-reverse xl:flex-row">
            <div class="flex-1">
                <p class="text-justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum similique nobis
                    enim,
                    in ipsum blanditiis Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit iste itaque excepturi
                    quas at reprehenderit harum adipisci reiciendis mollitia nulla? ipsum blanditiis Lorem ipsum dolor sit
                    amet, consectetur adipisicing elit. Odit iste itaque excepturi
                    quas at reprehenderit harum adipisci reiciendis mollitia nulla? rem mollitia. Tenetur neque animi, quasi
                    possimus
                    laudantium modi magnam, vero sed dolorum assumenda quos quasi voluptatum sit tempora minus voluptatem
                    eos praesentium. Magni nesciunt aspernatur dolorem ratione molestias autem recusandae doloremque
                    cupiditate quaerat iusto ad magnam adipisci obcaecati veniam, asperiores repellat laborum deserunt modi
                    laudantium reiciendis tempore, omnis odio sunt. Expedita, inventore est necessitatibus aliquid pariatur
                    enim debitis quaerat fugit. Facilis, illum quod in praesentium debitis commodi dolores provident
                    necessitatibus earum laudantium deserunt, corrupti quaerat reiciendis!</p>
            </div>
            <div class="flex-1">
                <img class="w-full object-cover h-[250px] md:h-[280px] lg:h-[350px]"
                    src="{{ asset('images/not-found/not-photo.jpg') }}" alt="">
            </div>
        </main>
        <div class="social-media mt-10 md:mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <a href=""
                class="w-full h-16 flex gap-3 justify-center items-center hover:bg-primary border-[0.5px] border-gray-200 shadow hover:shadow-none hover:text-white rounded">
                <i class="fab fa-instagram"></i> hema_indonesia
            </a>
            <a href=""
                class="w-full h-16 flex gap-3 justify-center items-center hover:bg-primary border-[0.5px] border-gray-200 shadow hover:shadow-none hover:text-white rounded">
                <i class="fab fa-tiktok"></i> hema_indonesia
            </a>
            <a href=""
                class="w-full h-16 flex gap-3 justify-center items-center hover:bg-primary border-[0.5px] border-gray-200 shadow hover:shadow-none hover:text-white rounded">
                <i class="fab fa-x-twitter"></i> hema_indonesia
            </a>
            <a href=""
                class="w-full h-16 flex gap-3 justify-center items-center hover:bg-primary border-[0.5px] border-gray-200 shadow hover:shadow-none hover:text-white rounded">
                <i class="fab fa-youtube"></i> hema_indonesia
            </a>
        </div>
    </section>
@endsection
