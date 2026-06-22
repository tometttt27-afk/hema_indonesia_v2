@extends('template.layout-main')
@section('title_web', 'FAQ | Hema.Indonesia')
@section('content-main')

<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list"><li><a href="{{ url('/') }}">Beranda</a></li><li>FAQ</li></ol>
        <h2 class="page-hero">Pertanyaan <span style="color:#b17457;">Umum</span></h2>
        <p>Temukan jawaban atas pertanyaan yang sering ditanyakan</p>
    </div>
</div>

<section class="container py-16">
    <div class="max-w-3xl mx-auto">
        @if($count_faq > 0)
            <div class="flex flex-col gap-3">
                @foreach($data as $faq)
                <div class="rounded-xl overflow-hidden" style="border:1.5px solid #ede3db;background:#fff;">
                    <button onclick="toggleFaq({{ $faq->id }})"
                        class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left"
                        style="background:transparent;border:none;cursor:pointer;">
                        <span class="font-semibold text-gray-800" style="font-size:15px;">{{ $faq->title }}</span>
                        <span id="faq-icon-{{ $faq->id }}"
                            class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300"
                            style="background:rgba(177,116,87,.1);color:#b17457;">
                            <i class="fas fa-plus text-xs"></i>
                        </span>
                    </button>
                    <div id="faq-body-{{ $faq->id }}"
                        class="overflow-hidden transition-all duration-300 ease-in-out"
                        style="max-height:0;">
                        <div class="px-6 pb-5" style="border-top:1px solid #f5ede6;">
                            <p class="text-gray-600 leading-relaxed text-sm mt-4">{{ $faq->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-question-circle"></i>
                <p>FAQ belum tersedia. Silakan hubungi kami langsung.</p>
            </div>
        @endif
    </div>
</section>

<script>
function toggleFaq(id) {
    const body = document.getElementById('faq-body-' + id);
    const icon = document.getElementById('faq-icon-' + id);
    const isOpen = body.style.maxHeight !== '0px' && body.style.maxHeight !== '';
    // Close all
    document.querySelectorAll('[id^="faq-body-"]').forEach(el => { el.style.maxHeight = '0'; });
    document.querySelectorAll('[id^="faq-icon-"]').forEach(el => {
        el.style.background = 'rgba(177,116,87,.1)'; el.style.transform = 'rotate(0deg)';
        el.innerHTML = '<i class="fas fa-plus text-xs"></i>';
    });
    if (!isOpen) {
        body.style.maxHeight = body.scrollHeight + 40 + 'px';
        icon.style.background = 'linear-gradient(135deg,#b17457,#c29470)';
        icon.style.color = '#fff';
        icon.innerHTML = '<i class="fas fa-minus text-xs"></i>';
    }
}
</script>

@endsection
