<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Website Hema Indonesia">
    <meta name="author" content="hema">
    <meta name="robots" content="noindex, nofollow">
    <meta name="success" content="{{ session('success') }}">
    <meta name="success_timer" content="{{ session('success_timer') }}">
    <meta name="error" content="{{ session('error') }}">
    <meta name="errors" content='@json($errors->all())'>
    <title>@yield('title_web')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/lightbox/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/hema-admin.css') }}">
</head>
<body>
<div class="main-wrapper">

    {{-- ═══ TOPBAR ═══ --}}
    <div class="header">
        <div class="header-left active">
            {{-- Logo: gunakan logo.png milik Hema Indonesia --}}
            <a href="{{ url('dashboard') }}" class="logo">
                <img src="{{ asset('admin/img/logo.png') }}" alt="Hema Indonesia">
            </a>
            <a href="{{ url('dashboard') }}" class="logo-small">
                <img src="{{ asset('admin/img/logo-small.png') }}" alt="Hema">
            </a>
            <a id="toggle_btn" href="javascript:void(0);" aria-label="Toggle sidebar"></a>
        </div>

        {{-- Mobile hamburger --}}
        <a id="mobile_btn" class="mobile_btn" href="#sidebar" aria-label="Buka menu">
            <span class="bar-icon"><span></span><span></span><span></span></span>
        </a>

        {{-- Right-side nav --}}
        <ul class="nav user-menu">

            {{-- Search --}}
            <li class="nav-item">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search" aria-label="Cari">
                        {{-- icon search siluet --}}
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" style="color:currentColor;">
                            <circle cx="11" cy="11" r="8" fill="currentColor" opacity=".15"/>
                            <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path stroke="currentColor" stroke-width="2.5" stroke-linecap="round" d="M21 21l-4.35-4.35"/>
                        </svg>
                    </a>
                    <form action="#">
                        <div class="searchinputs">
                            <input type="text" placeholder="Cari produk, pesanan...">
                            <div class="search-addon">
                                <span>
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <a class="btn" id="searchdiv" aria-label="Cari">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8" fill="currentColor" opacity=".15"/>
                                <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" fill="none"/>
                                <path stroke="currentColor" stroke-width="2.5" stroke-linecap="round" d="M21 21l-4.35-4.35"/>
                            </svg>
                        </a>
                    </form>
                </div>
            </li>

            {{-- User dropdown --}}
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown" aria-label="Menu pengguna">
                    <span class="user-img">
                        <img src="{{ asset('uploads/profile/' . (auth()->user()->profile_img ?? 'default_profile.jpg')) }}" alt="profil">
                        <span class="status online"></span>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilename">
                        <div class="profileset">
                            <div class="profilesets">
                                <h6>{{ auth()->user()->first_name ?? auth()->user()->email }}</h6>
                                <h5>{{ ucfirst(auth()->user()->role) }}</h5>
                            </div>
                        </div>
                        <hr class="m-0">
                        <a class="dropdown-item" href="{{ url('/profile') }}">
                            {{-- icon person siluet --}}
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" class="me-2">
                                <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-5.33 0-8 2.67-8 4v1h16v-1c0-1.33-2.67-4-8-4z"/>
                            </svg>
                            Profil Saya
                        </a>
                        <hr class="m-0">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item logout" type="submit">
                                {{-- icon logout siluet --}}
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" class="me-2">
                                    <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5-5-5zM4 5h8V3H4a2 2 0 00-2 2v14a2 2 0 002 2h8v-2H4V5z"/>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>

        {{-- Mobile ellipsis --}}
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-label="Menu">
                <svg width="4" height="18" fill="currentColor" viewBox="0 0 4 18">
                    <circle cx="2" cy="2" r="2"/><circle cx="2" cy="9" r="2"/><circle cx="2" cy="16" r="2"/>
                </svg>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ url('/profile') }}">Profil Saya</a>
                <hr class="my-1">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="dropdown-item" type="submit">Keluar</button>
                </form>
            </div>
        </div>
    </div>
    {{-- /TOPBAR --}}


    {{-- ═══ SIDEBAR ═══ --}}
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>

                    {{-- ── Dashboard ── --}}
                    <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <a href="{{ url('dashboard') }}" aria-label="Dashboard">
                            {{-- icon grid siluet --}}
                            <svg class="sb-icon" fill="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                                <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                                <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                                <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- ── KATALOG ── --}}
                    <li class="menu-title"><span>Katalog</span></li>

                    @php $produkOpen = request()->is('product-list*','categories*'); @endphp
                    <li class="submenu {{ $produkOpen ? 'active subdrop' : '' }}">
                        <a href="javascript:void(0);" class="sidebar-submenu-toggle"
                           aria-expanded="{{ $produkOpen ? 'true' : 'false' }}">
                            {{-- icon box siluet --}}
                            <svg class="sb-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
                            </svg>
                            <span>Produk</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul @if(!$produkOpen) style="display:none;" @endif>
                            <li class="{{ request()->is('product-list*') ? 'active' : '' }}">
                                <a href="{{ url('/product-list') }}">Data Produk</a>
                            </li>
                            <li class="{{ request()->is('categories*') ? 'active' : '' }}">
                                <a href="{{ url('/categories') }}">Kategori</a>
                            </li>
                        </ul>
                    </li>

                    {{-- ── TRANSAKSI ── --}}
                    <li class="menu-title"><span>Transaksi</span></li>

                    <li class="{{ request()->is('order-list*') ? 'active' : '' }}">
                        <a href="{{ url('/order-list') }}" aria-label="Pesanan">
                            {{-- icon bag siluet --}}
                            <svg class="sb-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4H6z" opacity=".25"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 5.5L6.2 2h11.6l2.7 3.5H3.5zM5 7v13h14V7H5zm3 3a4 4 0 008 0h-2a2 2 0 01-4 0H8z"/>
                            </svg>
                            <span>Pesanan</span>
                        </a>
                    </li>

                    {{-- ── MASTER ── --}}
                    <li class="menu-title"><span>Master</span></li>

                    <li class="{{ request()->is('customer*') ? 'active' : '' }}">
                        <a href="{{ url('/customer') }}" aria-label="Pelanggan">
                            {{-- icon people siluet --}}
                            <svg class="sb-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                            </svg>
                            <span>Pelanggan</span>
                        </a>
                    </li>

                    @php $kontenOpen = request()->is('gallery-company*','faq-company*','about-company*'); @endphp
                    <li class="submenu {{ $kontenOpen ? 'active subdrop' : '' }}">
                        <a href="javascript:void(0);" class="sidebar-submenu-toggle"
                           aria-expanded="{{ $kontenOpen ? 'true' : 'false' }}">
                            {{-- icon globe/website siluet --}}
                            <svg class="sb-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                            </svg>
                            <span>Konten Web</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul @if(!$kontenOpen) style="display:none;" @endif>
                            <li class="{{ request()->is('gallery-company*') ? 'active' : '' }}">
                                <a href="{{ url('gallery-company') }}">Galeri</a>
                            </li>
                            <li class="{{ request()->is('faq-company*') ? 'active' : '' }}">
                                <a href="{{ url('/faq-company') }}">FAQ</a>
                            </li>
                            <li class="{{ request()->is('about-company*') ? 'active' : '' }}">
                                <a href="{{ url('/about-company') }}">Profil Perusahaan</a>
                            </li>
                        </ul>
                    </li>

                    {{-- ── AKUN ── --}}
                    <li class="menu-title"><span>Akun</span></li>

                    <li class="{{ request()->is('profile*') ? 'active' : '' }}">
                        <a href="{{ url('/profile') }}" aria-label="Profil Saya">
                            {{-- icon person siluet --}}
                            <svg class="sb-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-5.33 0-8 2.67-8 4v1h16v-1c0-1.33-2.67-4-8-4z"/>
                            </svg>
                            <span>Profil Saya</span>
                        </a>
                    </li>

                    <li>
                        <form action="{{ route('logout') }}" method="post" id="sidebar-logout-form">
                            @csrf
                            <a href="javascript:void(0);"
                               onclick="document.getElementById('sidebar-logout-form').submit();"
                               aria-label="Keluar">
                                {{-- icon logout siluet --}}
                                <svg class="sb-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5-5-5zM4 5h8V3H4a2 2 0 00-2 2v14a2 2 0 002 2h8v-2H4V5z"/>
                                </svg>
                                <span>Keluar</span>
                            </a>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    {{-- /SIDEBAR --}}


    {{-- ═══ PAGE WRAPPER ═══ --}}
    <div class="page-wrapper">
        <div class="content">
            @yield('content-admin')
        </div>
    </div>

</div>{{-- /main-wrapper --}}

<script src="{{ asset('admin/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/js/feather.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin/plugins/apexchart/chart-data.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/js/custom-select.js') }}"></script>
<script src="{{ asset('admin/plugins/lightbox/glightbox.min.js') }}"></script>
<script src="{{ asset('admin/plugins/lightbox/lightbox.js') }}"></script>
<script src="{{ asset('library/sweetalert/sweetalert2.min.js') }}"></script>
<script src="{{ asset('admin/js/script.js') }}"></script>
<script src="{{ asset('admin/js/form-input.js') }}"></script>
<script src="{{ asset('js/alert.js') }}"></script>

{{-- ═══ GLOBAL JS ═══ --}}
<div id="sidebar-overlay"></div>
<script>
(function () {

    /* ──────────────────────────────────────────────────────
       A. LOADING STATE — semua form submit
       Nonaktifkan tombol submit + tampilkan spinner
    ────────────────────────────────────────────────────── */
    document.addEventListener('submit', function (e) {
        var form = e.target;
        // Kecualikan form delete (submit via JS/SweetAlert) dan form logout
        if (form.classList.contains('d-none')) return;
        if (form.id === 'sidebar-logout-form') return;

        var submitBtn = form.querySelector('[type="submit"]:not([data-no-loading])');
        if (!submitBtn) return;

        var originalHTML = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML =
            '<svg class="spin-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">' +
            '<path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>' +
            '</svg> Menyimpan...';

        // Safeguard: pulihkan tombol jika form gagal/redirect tidak terjadi dalam 8 detik
        setTimeout(function () {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHTML;
        }, 8000);
    });

    /* ──────────────────────────────────────────────────────
       B. KONFIRMASI BATAL — cegah navigasi saat form kotor
       Pasang pada semua tombol/link "Batal" di halaman form
    ────────────────────────────────────────────────────── */
    document.addEventListener('click', function (e) {
        var link = e.target.closest('a.btn-cancel-nav');
        if (!link) return;

        var formId = link.getAttribute('data-form');
        var form   = formId ? document.getElementById(formId)
                            : document.querySelector('form:not(.d-none)');
        if (!form) return;

        var inputs  = form.querySelectorAll('input:not([type=hidden]):not([readonly]), textarea, select');
        var isDirty = false;
        inputs.forEach(function (inp) {
            if (inp.type === 'checkbox' || inp.type === 'radio') {
                if (inp.defaultChecked !== inp.checked) isDirty = true;
            } else {
                if (inp.value !== inp.defaultValue) isDirty = true;
            }
        });

        if (isDirty) {
            e.preventDefault();
            Swal.fire({
                title       : 'Tinggalkan halaman?',
                text        : 'Data yang sudah diisi akan hilang.',
                icon        : 'warning',
                showCancelButton : true,
                confirmButtonText: 'Ya, tinggalkan',
                cancelButtonText : 'Lanjut edit',
                confirmButtonColor: '#b17457',
                cancelButtonColor : '#f5f3f0',
                reverseButtons   : true,
            }).then(function (res) {
                if (res.isConfirmed) window.location = link.href;
            });
        }
    });

    /* ──────────────────────────────────────────────────────
       C. SIDEBAR SUBMENU ACCORDION TOGGLE
    ────────────────────────────────────────────────────── */
    var triggers = document.querySelectorAll('.sidebar-submenu-toggle');

    triggers.forEach(function (trigger) {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var parentLi = this.closest('li.submenu');
            var subUl    = parentLi ? parentLi.querySelector(':scope > ul') : null;
            if (!parentLi || !subUl) return;

            var isOpen = parentLi.classList.contains('subdrop');

            document.querySelectorAll('#sidebar-menu li.submenu.subdrop').forEach(function (li) {
                if (li === parentLi) return;
                li.classList.remove('subdrop', 'active');
                var ul = li.querySelector(':scope > ul');
                if (ul) {
                    ul.style.maxHeight = ul.scrollHeight + 'px';
                    requestAnimationFrame(function () {
                        ul.style.transition = 'max-height .26s cubic-bezier(.4,0,.2,1), opacity .2s ease';
                        ul.style.maxHeight  = '0';
                        ul.style.opacity    = '0';
                        ul.style.overflow   = 'hidden';
                    });
                    ul.addEventListener('transitionend', function h() {
                        ul.style.display = 'none';
                        ul.style.maxHeight = ul.style.opacity = ul.style.overflow = '';
                        ul.removeEventListener('transitionend', h);
                    });
                }
                var tog = li.querySelector('.sidebar-submenu-toggle');
                if (tog) tog.setAttribute('aria-expanded', 'false');
            });

            if (isOpen) {
                parentLi.classList.remove('subdrop');
                if (!parentLi.querySelector('ul li.active')) parentLi.classList.remove('active');
                subUl.style.maxHeight = subUl.scrollHeight + 'px';
                subUl.style.overflow  = 'hidden';
                requestAnimationFrame(function () {
                    subUl.style.transition = 'max-height .26s cubic-bezier(.4,0,.2,1), opacity .2s ease';
                    subUl.style.maxHeight  = '0';
                    subUl.style.opacity    = '0';
                });
                subUl.addEventListener('transitionend', function h() {
                    subUl.style.display = 'none';
                    subUl.style.maxHeight = subUl.style.opacity = subUl.style.overflow = '';
                    subUl.removeEventListener('transitionend', h);
                });
                this.setAttribute('aria-expanded', 'false');
            } else {
                parentLi.classList.add('subdrop', 'active');
                subUl.style.display  = 'block';
                subUl.style.maxHeight = '0';
                subUl.style.opacity  = '0';
                subUl.style.overflow = 'hidden';
                var targetH = subUl.scrollHeight;
                requestAnimationFrame(function () {
                    subUl.style.transition = 'max-height .26s cubic-bezier(.4,0,.2,1), opacity .2s ease';
                    subUl.style.maxHeight  = targetH + 'px';
                    subUl.style.opacity    = '1';
                });
                subUl.addEventListener('transitionend', function h() {
                    subUl.style.maxHeight = subUl.style.overflow = '';
                    subUl.removeEventListener('transitionend', h);
                });
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    /* Submenu aktif dari server → langsung tampil */
    document.querySelectorAll('#sidebar-menu li.submenu.subdrop > ul').forEach(function (ul) {
        ul.style.display = 'block';
        ul.style.opacity = '1';
    });

}());
</script>

</body>
</html>
