@extends('template.layout-main')
@section('title_web', 'Galeri | Hema.Indonesia')
@section('content-main')

<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list"><li><a href="{{ url('/') }}">Beranda</a></li><li>Galeri</li></ol>
        <h2 class="page-hero">Galeri <span style="color:#b17457;">Kami</span></h2>
        <p>Koleksi foto produk dan aktivitas Hema.Indonesia</p>
    </div>
</div>

<section class="container py-16">
    @if($count_gallery > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($data as $gallery)
            <div class="group relative overflow-hidden rounded-xl" style="border:1.5px solid #ede3db;">
                <a href="{{ asset('uploads/gallery/'.$gallery->image) }}" class="image-popup block">
                    <img class="w-full object-cover transition-transform duration-500 group-hover:scale-105"
                        style="height:220px;"
                        src="{{ asset('uploads/gallery/'.$gallery->image) }}"
                        alt="{{ $gallery->title }}">
                    <div class="absolute inset-0 flex flex-col justify-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        style="background:linear-gradient(to top,rgba(30,20,16,.8),transparent);">
                        <p class="text-white font-semibold text-sm leading-tight">{{ $gallery->title }}</p>
                        @if($gallery->description)
                            <p class="text-white/70 text-xs mt-1">{{ Str::limit($gallery->description,50) }}</p>
                        @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-images"></i>
            <p>Galeri belum tersedia.</p>
        </div>
    @endif
</section>

@endsection
