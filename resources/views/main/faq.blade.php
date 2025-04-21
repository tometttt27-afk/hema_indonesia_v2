@extends('template.layout-main')
@section('title_web', 'FAQ | Hema.Indonesia')
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
                            <a href="{{ url('/faq') }}">FAQ</a>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-[20px] md:text-2xl font-bold">
                    FAQ | <span class="text-primary">Hema</span>.Indonesia
                </h2>
                <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, id?</p>
            </div>
        </div>
    </div>

    <section class="about container py-24">
        <main class="content flex w-full gap-[1rem] items-start justify-start flex-wrap">
            @if ($count_faq > 0)
                @foreach ($data as $faq)
                    <div class="border shadow-sm break-all w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                        <button onclick="toggleAccordion({{ $faq->id }})"
                            class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                            <p class="text-left">{{ $faq->title }}</p>
                            <span id="icon-1" class="text-slate-800 transition-transform duration-300">
                                <i class="fas fa-plus text-sm"></i>
                            </span>
                        </button>
                        <div id="content-{{ $faq->id }}"
                            class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                                <span>{{ $faq->description }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div
                    class="border shadow-sm text-center flex justify-center items-center w-full lg:w-full border-slate-200 p-5">
                    <p>Data FAQ tidak dapat ditemukan!</p>
                </div>
            @endif
        </main>
    </section>
@endsection
