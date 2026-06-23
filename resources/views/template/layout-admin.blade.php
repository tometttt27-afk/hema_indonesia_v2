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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/lightbox/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('admin/css/style1.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('admin/css/hema-admin.css') }}">
</head>
<body>
<div class="main-wrapper">

    {{-- ═══ TOPBAR ═══ --}}
    <div class="header">
        {{-- Logo zone --}}
        <div class="header-left active">
            <a href="{{ url('dashboard') }}" class="logo">
                <img src="{{ asset('admin/img/logo.png') }}" alt="Hema Indonesia">
            </a>
            <a href="{{ url('dashboard') }}" class="logo-small">
                <img src="{{ asset('admin/img/logo-small.png') }}" alt="">
            </a>
            <a id="toggle_btn" href="javascript:void(0);"></a>
        </div>

        {{-- Mobile hamburger --}}
        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon"><span></span><span></span><span></span></span>
        </a>

        {{-- Right-side nav --}}
        <ul class="nav user-menu">

            {{-- Search --}}
            <li class="nav-item">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                    <form action="#">
                        <div class="searchinputs">
                            <input type="text" placeholder="Cari di sini ...">
                            <div class="search-addon">
                                <span><img src="{{ asset('admin/img/icons/closes.svg') }}" alt="tutup"></span>
                            </div>
                        </div>
                        <a class="btn" id="searchdiv">
                            <img src="{{ asset('admin/img/icons/search.svg') }}" alt="cari">
                        </a>
                    </form>
                </div>
            </li>

            {{-- User dropdown --}}
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
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
                            <i class="bi bi-person me-2"></i>Profil Saya
                        </a>
                        <hr class="m-0">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item logout" type="submit">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>

        {{-- Mobile ellipsis --}}
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ url('/profile') }}">Profil Saya</a>
                <hr class="my-1">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="dropdown-item" type="submit">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
    {{-- /TOPBAR --}}


    {{-- ═══ SIDEBAR ═══ --}}
    <div class="sidebar" id="sidebar">

        {{-- Tombol panah toggle: menempel di tepi kanan sidebar --}}
        <button id="sidebar-toggle-btn"
                title="Tutup / Buka sidebar"
                aria-label="Toggle sidebar">
            <i class="bi bi-chevron-left" id="toggle-icon"></i>
        </button>

        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>

                    {{-- ── Dashboard ── --}}
                    <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <a href="{{ url('dashboard') }}">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- ── KATALOG ── --}}
                    <li class="menu-title"><span>Katalog</span></li>

                    {{-- Produk (submenu) --}}
                    @php
                        $produkOpen = request()->is('product-list*','categories*');
                    @endphp
                    <li class="submenu {{ $produkOpen ? 'active subdrop' : '' }}">
                        <a href="javascript:void(0);"
                           class="sidebar-submenu-toggle"
                           aria-expanded="{{ $produkOpen ? 'true' : 'false' }}">
                            <i class="bi bi-box-seam"></i>
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

                    {{-- Pesanan --}}
                    <li class="{{ request()->is('order-list*') ? 'active' : '' }}">
                        <a href="{{ url('/order-list') }}">
                            <i class="bi bi-bag-check"></i>
                            <span>Pesanan</span>
                        </a>
                    </li>

                    {{-- ── MASTER ── --}}
                    <li class="menu-title"><span>Master</span></li>

                    {{-- Pelanggan --}}
                    <li class="{{ request()->is('customer*') ? 'active' : '' }}">
                        <a href="{{ url('/customer') }}">
                            <i class="bi bi-people"></i>
                            <span>Pelanggan</span>
                        </a>
                    </li>

                    {{-- Konten Web (submenu) --}}
                    @php
                        $kontenOpen = request()->is('gallery-company*','faq-company*','about-company*');
                    @endphp
                    <li class="submenu {{ $kontenOpen ? 'active subdrop' : '' }}">
                        <a href="javascript:void(0);"
                           class="sidebar-submenu-toggle"
                           aria-expanded="{{ $kontenOpen ? 'true' : 'false' }}">
                            <i class="bi bi-building"></i>
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
{{-- sweetalerts.min.js bawaan template DINONAKTIFKAN karena
     mendefinisikan ulang handler .confirm-text sendiri dan
     menginterferensi dengan alert.js kita. --}}
{{-- <script src="{{ asset('library/sweetalert/sweetalerts.min.js') }}"></script> --}}
<script src="{{ asset('admin/js/script.js') }}"></script>
<script src="{{ asset('admin/js/form-input.js') }}"></script>
<script src="{{ asset('js/alert.js') }}"></script>

{{-- ═══ SIDEBAR TOGGLE & SUBMENU — JS ═══
     Logika:
     1. Tombol panah (‹/›) di tepi kanan sidebar → collapse/expand sidebar
     2. State disimpan di localStorage agar persisten antar halaman
     3. Saat collapsed: sidebar geser kiri, page-wrapper melebar penuh
     4. Submenu accordion: klik trigger → expand/collapse smooth
     Tidak mengubah logika script.js / toggle_btn / mini-sidebar yang ada.
═══════════════════════════════════════ --}}
<div id="sidebar-overlay"></div>
<script>
(function () {
    /* ══════════════════════════════════════════════════════════
       A. SIDEBAR TOGGLE (panah ‹/›)
    ══════════════════════════════════════════════════════════ */
    var STORAGE_KEY  = 'hema_sidebar_collapsed';
    var body         = document.body;
    var toggleBtn    = document.getElementById('sidebar-toggle-btn');
    var toggleIcon   = document.getElementById('toggle-icon');
    var isCollapsed  = localStorage.getItem(STORAGE_KEY) === '1';

    /* ── Terapkan state dari localStorage ─────────────────── */
    function applyCollapsed(collapsed) {
        isCollapsed = collapsed;
        localStorage.setItem(STORAGE_KEY, collapsed ? '1' : '0');

        if (collapsed) {
            body.classList.add('sidebar-collapsed');
            if (toggleBtn) toggleBtn.title = 'Buka sidebar';
        } else {
            body.classList.remove('sidebar-collapsed');
            if (toggleBtn) toggleBtn.title = 'Tutup sidebar';
        }
    }

    /* Init saat halaman load */
    applyCollapsed(isCollapsed);

    /* Klik tombol panah → toggle */
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            applyCollapsed(!isCollapsed);
        });
    }

    /* Jaga layar mobile: selalu tampil, abaikan state collapsed */
    window.addEventListener('resize', function () {
        if (window.innerWidth <= 991) {
            body.classList.remove('sidebar-collapsed');
        }
    });
    if (window.innerWidth <= 991) {
        body.classList.remove('sidebar-collapsed');
    }


    /* ══════════════════════════════════════════════════════════
       B. SUBMENU ACCORDION TOGGLE
       — Menangani klik pada .sidebar-submenu-toggle secara
         mandiri, tanpa bergantung pada script.js template.
       — Hanya satu submenu terbuka dalam satu waktu.
    ══════════════════════════════════════════════════════════ */
    var triggers = document.querySelectorAll('.sidebar-submenu-toggle');

    function closeSubmenu(li) {
        li.classList.remove('subdrop', 'active');
        var ul  = li.querySelector(':scope > ul');
        var tog = li.querySelector('.sidebar-submenu-toggle');
        if (ul) {
            ul.style.maxHeight = ul.scrollHeight + 'px';
            ul.style.overflow  = 'hidden';
            requestAnimationFrame(function () {
                ul.style.transition = 'max-height .28s cubic-bezier(.4,0,.2,1), opacity .22s ease';
                ul.style.maxHeight  = '0';
                ul.style.opacity    = '0';
            });
            ul.addEventListener('transitionend', function handler() {
                ul.style.display   = 'none';
                ul.style.maxHeight = '';
                ul.style.opacity   = '';
                ul.style.overflow  = '';
                ul.removeEventListener('transitionend', handler);
            });
        }
        if (tog) tog.setAttribute('aria-expanded', 'false');
    }

    function openSubmenu(li) {
        var ul  = li.querySelector(':scope > ul');
        var tog = li.querySelector('.sidebar-submenu-toggle');
        li.classList.add('subdrop', 'active');
        if (ul) {
            ul.style.display   = 'block';
            ul.style.maxHeight = '0';
            ul.style.opacity   = '0';
            ul.style.overflow  = 'hidden';
            var targetH = ul.scrollHeight;
            requestAnimationFrame(function () {
                ul.style.transition = 'max-height .28s cubic-bezier(.4,0,.2,1), opacity .22s ease';
                ul.style.maxHeight  = targetH + 'px';
                ul.style.opacity    = '1';
            });
            ul.addEventListener('transitionend', function handler() {
                ul.style.maxHeight = '';
                ul.style.overflow  = '';
                ul.removeEventListener('transitionend', handler);
            });
        }
        if (tog) tog.setAttribute('aria-expanded', 'true');
    }

    triggers.forEach(function (trigger) {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var parentLi = this.closest('li.submenu');
            if (!parentLi) return;

            var isOpen = parentLi.classList.contains('subdrop');

            /* Tutup semua submenu lain dulu */
            document.querySelectorAll('#sidebar-menu li.submenu.subdrop').forEach(function (li) {
                if (li !== parentLi) closeSubmenu(li);
            });

            if (isOpen) {
                /* Jika tidak ada child aktif, tutup */
                if (!parentLi.querySelector('ul li.active')) {
                    closeSubmenu(parentLi);
                }
            } else {
                openSubmenu(parentLi);
            }
        });
    });

    /* Pastikan submenu aktif dari server langsung tampil tanpa animasi */
    document.querySelectorAll('#sidebar-menu li.submenu.subdrop > ul').forEach(function (ul) {
        ul.style.display = 'block';
        ul.style.opacity = '1';
    });

}());
</script>

</body>
</html>
