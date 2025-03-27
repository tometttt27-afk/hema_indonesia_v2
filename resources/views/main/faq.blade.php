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
            <div class="border shadow-sm w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                <button onclick="toggleAccordion(1)"
                    class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                    <span class="text-left">What is Material Tailwind?</span>
                    <span id="icon-1" class="text-slate-800 transition-transform duration-300">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                </button>
                <div id="content-1" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                        Material Tailwind is a framework that enhances Tailwind CSS with additional styles and components.
                    </div>
                </div>
            </div>
            <div class="border shadow-sm w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                <button onclick="toggleAccordion(2)"
                    class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                    <span class="text-left">How to use Material Tailwind?</span>
                    <span id="icon-2" class="text-slate-800 transition-transform duration-300">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                </button>
                <div id="content-2" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                        You can use Material Tailwind by importing its components into your Tailwind CSS project.
                    </div>
                </div>
            </div>
            <div class="border shadow-sm w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                <button onclick="toggleAccordion(3)"
                    class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                    <span class="text-left">What can I do with Material Tailwind?</span>
                    <span id="icon-3" class="text-slate-800 transition-transform duration-300">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                </button>
                <div id="content-3" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                        Material Tailwind allows you to quickly build modern, responsive websites with a focus on design.
                    </div>
                </div>
            </div>
            <div class="border shadow-sm w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                <button onclick="toggleAccordion(4)"
                    class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                    <span class="text-left">What is Material Tailwind?</span>
                    <span id="icon-4" class="text-slate-800 transition-transform duration-300">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                </button>
                <div id="content-4" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                        Material Tailwind is a framework that enhances Tailwind CSS with additional styles and components.
                    </div>
                </div>
            </div>
            <div class="border shadow-sm w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                <button onclick="toggleAccordion(5)"
                    class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                    <span class="text-left">How to use Material Tailwind?</span>
                    <span id="icon-5" class="text-slate-800 transition-transform duration-300">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                </button>
                <div id="content-5" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                        You can use Material Tailwind by importing its components into your Tailwind CSS project.
                    </div>
                </div>
            </div>
            <div class="border shadow-sm w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                <button onclick="toggleAccordion(6)"
                    class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                    <span class="text-left">What can I do with Material Tailwind?</span>
                    <span id="icon-6" class="text-slate-800 transition-transform duration-300">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                </button>
                <div id="content-6" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                        Material Tailwind allows you to quickly build modern, responsive websites with a focus on design.
                    </div>
                </div>
            </div>
            <div class="border shadow-sm w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                <button onclick="toggleAccordion(7)"
                    class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                    <span class="text-left">What is Material Tailwind?</span>
                    <span id="icon-7" class="text-slate-800 transition-transform duration-300">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                </button>
                <div id="content-7" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                        Material Tailwind is a framework that enhances Tailwind CSS with additional styles and components.
                    </div>
                </div>
            </div>
            <div class="border shadow-sm w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                <button onclick="toggleAccordion(8)"
                    class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                    <span class="text-left">How to use Material Tailwind?</span>
                    <span id="icon-8" class="text-slate-800 transition-transform duration-300">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                </button>
                <div id="content-8" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                        You can use Material Tailwind by importing its components into your Tailwind CSS project.
                    </div>
                </div>
            </div>
            <div class="border shadow-sm w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                <button onclick="toggleAccordion(9)"
                    class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                    <span class="text-left">What can I do with Material Tailwind?</span>
                    <span id="icon-9" class="text-slate-800 transition-transform duration-300">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                </button>
                <div id="content-9" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                        Material Tailwind allows you to quickly build modern, responsive websites with a focus on design.
                    </div>
                </div>
            </div>
            <div class="border shadow-sm w-full lg:w-[calc(100%_/_2_-_1rem)] border-slate-200 px-5">
                <button onclick="toggleAccordion(10)"
                    class="w-full flex justify-between items-center gap-5 py-5 text-slate-800">
                    <span class="text-left">What can I do with Material Tailwind?</span>
                    <span id="icon-10" class="text-slate-800 transition-transform duration-300">
                        <i class="fas fa-plus text-sm"></i>
                    </span>
                </button>
                <div id="content-10" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                    <div class="pb-5 text-[14.5px] tracking-wide text-slate-500 text-justify">
                        Material Tailwind allows you to quickly build modern, responsive websites with a focus on design.
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection
