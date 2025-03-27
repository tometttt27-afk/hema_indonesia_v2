@extends('template.layout-main')
@section('title_web', 'Produk | Hema.Indonesia')
@section('content-main')
    <div id="hero" class="header-hero bg-[#f5f5f5]">
        <div class="container py-10">
            <div class="">
                <h2 class="text-[20px] md:text-2xl font-bold">
                    Produk | <span class="text-primary">Hema</span>.Indonesia
                </h2>
                <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, id?</p>
            </div>
        </div>
    </div>

    <section id="product_section" class="product container pt-12 pb-24">
        <div class="header-title flex lg:flex-row flex-col justify-between items-start lg:items-center">
            <div class="title flex items-center gap-3">
                <h1 class="text-xl font-semibold">Sale Produk</h1>
                <h4 class="px-3 rounded-sm font-semibold text-white py-1.5 bg-gradient-to-r from-primary to-secondary">89
                </h4>
            </div>
            <div class="filter">
                <input oninput="filterSearchProduct(event)"
                    class="text-sm focus:border-primary tracking-wider inline-block cursor-pointer mt-3 px-4 py-[8px] outline-none rounded-sm  border-[1.5px] border-[#f1f1f1]"
                    autocomplete="off" type="search" name="search" id="search_product" placeholder="Searching...">
                <select onchange="filterSelectCategory(event)"
                    class="text-sm bg-white focus:border-primary tracking-wider inline-block cursor-pointer mt-3 px-4 py-[8px] outline-none rounded-sm  border-[1.5px] border-[#f1f1f1]"
                    name="category_product" id="category_product">
                    <option value="all">All</option>
                    <option value="gamis">Gamis</option>
                    <option value="abaya">Abaya</option>
                    <option value="khimar">Khimar</option>
                    <option value="jubah">Jubah</option>
                    <option value="tas">Tas</option>
                </select>
            </div>
        </div>
        <div class="content" id="product main">
            <main id="product_list" class="grid grid-cols-2 xl:grid-cols-3 gap-4 md:gap-8 mt-12">
                <div class="product_box" data-category="abaya" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Abaya</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="khimar" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/khimar_1691223288_180218224123259268_6072612170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Khimar</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 300.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="tas" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/tas_221122981_21134342416559268_607323245401002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Tas</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 80.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="abaya" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Abaya</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="khimar" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/khimar_1691223288_180218224123259268_6072612170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Khimar</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 300.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="tas" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/tas_221122981_21134342416559268_607323245401002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Tas</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 80.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="abaya" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Abaya</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="khimar" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/khimar_1691223288_180218224123259268_6072612170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Khimar</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 300.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="tas" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/tas_221122981_21134342416559268_607323245401002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Tas</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 80.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="abaya" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Abaya</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="khimar" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/khimar_1691223288_180218224123259268_6072612170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Khimar</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 300.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="tas" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/tas_221122981_21134342416559268_607323245401002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Tas</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 80.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="abaya" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/abaya_469122888_18021822416559268_6072695170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Abaya</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="khimar" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/khimar_1691223288_180218224123259268_6072612170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Khimar</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 300.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" data-category="tas" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/tas_221122981_21134342416559268_607323245401002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Tas</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 80.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/khimar_1691223288_180218224123259268_6072612170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/khimar_1691223288_180218224123259268_6072612170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/khimar_1691223288_180218224123259268_6072612170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/khimar_1691223288_180218224123259268_6072612170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_box" id="product_box">
                    <div class="img w-full">
                        <img class="w-full h-[200px] md:h-[500px] object-cover"
                            src="{{ asset('uploads/produk/khimar_1691223288_180218224123259268_6072612170301002468_n_1080.jpg') }}"
                            alt="">
                    </div>
                    <div class="detail flex flex-col items-center justify-center w-full gap-3 py-5 px-3.5 text-center">
                        <h3 class="text-sm md:text-[16px] font-medium">Lorem ipsum dolor sit amet consectetur.</h3>
                        <p class="text-[12px] md:text-sm text-red-400">Rp. 250.000</p>
                        <div class="size flex items-center gap-2 cursor-default text-[9.5px] md:text-xs">
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>M</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>L</p>
                            </div>
                            <div
                                class="w-4 h-4 rounded-sm md:w-6 md:h-6 font-medium flex justify-center items-center text-white bg-gradient-to-r from-primary to-secondary">
                                <p>XL</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <div class="w-full text-[13px] md:text[14.5px] lg:text-[16px] hidden px-3 py-6 justify-center items-center text-center shadow-sm border-[0.5px] border-gray-200 rounded"
                id="product_not_found">
                <p class="tracking-wider"><i class="fas fa-magnifying-glass"></i> Pencarian produk tidak ditemukan!</p>
            </div>
            <div id="main_product_pagination" class="w-full border-t border-gray-200 font-mono mt-16">
                <nav id="product_pagination" class="pagination flex flex-wrap justify-center text-gray-700 -mt-px">
                    <button type="button" id="prev-product"
                        class="px-2 text-[12px] md:text-sm py-[11px] lg:py-3 xl:py-2.5 mx-1 border-t border-transparent hover:border-gray-700">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button id="next-product" type="button"
                        class="px-2 text-[12px] md:text-sm py-[11px] lg:py-3 xl:py-2.5 mx-1 border-t border-transparent hover:border-gray-700">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </nav>
            </div>
        </div>
    </section>
@endsection
