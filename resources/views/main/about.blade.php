@extends('template.layout-main')
@section('title_web', 'Tentang | Hema.Indonesia')
@section('content-main')

<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li>Tentang</li>
        </ol>
        <h2 class="page-hero">Tentang <span style="color:#b17457;">{{ $data_about->name ?? 'Hema' }}</span>.Indonesia</h2>
        <p>{{ $data_about->breadcrumb ?? 'Mengenal lebih dekat perusahaan kami' }}</p>
    </div>
</div>

<section class="container py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center mb-16">
        <div>
            <span class="text-xs font-bold tracking-[2px] uppercase" style="color:#b17457;">Siapa Kami</span>
            <h2 class="text-2xl font-extrabold text-gray-900 mt-2 mb-4">
                <span style="color:#b17457;">Hema</span>.Indonesia
            </h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $data_about->about_description_company ?? 'Deskripsi perusahaan belum tersedia.' }}
            </p>
        </div>
        <div>
            <img class="w-full rounded-xl object-cover"
                style="height:360px;border:2px solid #ede3db;"
                src="{{ $data_about && $data_about->about_img_company ? asset('uploads/about/'.$data_about->about_img_company) : asset('images/not-found/not-photo.jpg') }}"
                alt="About">
        </div>
    </div>

    {{-- Social media --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 mb-5 text-center">Temukan Kami Di</h3>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['fab fa-instagram','Instagram',$data_about->instagram??'#','#e1306c','rgba(225,48,108,.08)'],
                ['fab fa-tiktok','TikTok',$data_about->tiktok??'#','#000','rgba(0,0,0,.06)'],
                ['fab fa-facebook-f','Facebook',$data_about->facebook??'#','#1877f2','rgba(24,119,242,.08)'],
                ['fab fa-youtube','YouTube',$data_about->youtube??'#','#ff0000','rgba(255,0,0,.08)'],
            ] as $s)
            <a href="{{ $s[2] }}" target="_blank"
               class="flex items-center gap-3 p-4 rounded-xl font-semibold text-sm transition-all duration-200"
               style="background:{{ $s[4] }};border:1.5px solid {{ $s[3] }}22;color:{{ $s[3] }};text-decoration:none;"
               onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 18px {{ $s[3] }}33';"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none';">
                <i class="{{ $s[0] }} text-xl" style="color:{{ $s[3] }};"></i>
                {{ $s[1] }}
                <i class="fas fa-arrow-up-right-from-square text-xs ms-auto opacity-50"></i>
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection
