<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 — Halaman Tidak Ditemukan | Hema.Indonesia</title>
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
          integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: "Urbanist", sans-serif;
            background: #faf7f4;
            color: #3d2e26;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .error-wrap {
            text-align: center;
            max-width: 480px;
            width: 100%;
        }

        /* Ilustrasi angka 404 */
        .error-code {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 28px;
        }
        .error-code .num {
            font-size: clamp(80px, 18vw, 130px);
            font-weight: 900;
            line-height: 1;
            color: #ede3db;
            letter-spacing: -4px;
            user-select: none;
        }
        .error-code .icon-wrap {
            width: clamp(70px, 15vw, 110px);
            height: clamp(70px, 15vw, 110px);
            border-radius: 50%;
            background: linear-gradient(135deg, #b17457 0%, #c29470 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 8px 28px rgba(177, 116, 87, .35);
            animation: float 3s ease-in-out infinite;
        }
        .error-code .icon-wrap i {
            font-size: clamp(30px, 6vw, 48px);
            color: #ffffff;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0);    box-shadow: 0 8px 28px rgba(177,116,87,.35); }
            50%       { transform: translateY(-10px);box-shadow: 0 18px 38px rgba(177,116,87,.22); }
        }

        .error-title {
            font-size: clamp(20px, 5vw, 28px);
            font-weight: 800;
            color: #1e1410;
            margin-bottom: 10px;
        }

        .error-desc {
            font-size: 15px;
            font-weight: 400;
            color: #7a6255;
            line-height: 1.7;
            margin-bottom: 32px;
        }

        .error-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .btn-primary-err {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #b17457 0%, #c29470 100%);
            color: #ffffff;
            font-family: "Urbanist", sans-serif;
            font-weight: 700;
            font-size: 14px;
            padding: 11px 26px;
            border-radius: 8px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            transition: opacity .2s, box-shadow .2s;
            box-shadow: 0 3px 12px rgba(177,116,87,.28);
        }
        .btn-primary-err:hover {
            opacity: .88;
            box-shadow: 0 5px 18px rgba(177,116,87,.40);
            color: #ffffff;
        }

        .btn-outline-err {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #b17457;
            font-family: "Urbanist", sans-serif;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 24px;
            border-radius: 8px;
            border: 1.5px solid #b17457;
            text-decoration: none;
            cursor: pointer;
            transition: background .18s, color .18s;
        }
        .btn-outline-err:hover {
            background: #b17457;
            color: #ffffff;
        }

        /* Divider */
        .error-divider {
            width: 56px;
            height: 4px;
            border-radius: 50px;
            background: linear-gradient(135deg, #b17457, #c29470);
            margin: 0 auto 24px;
        }

        /* Suggestion links */
        .error-suggestions {
            margin-top: 28px;
            padding: 18px 24px;
            background: #ffffff;
            border: 1px solid #ede3db;
            border-radius: 10px;
        }
        .error-suggestions p {
            font-size: 12.5px;
            font-weight: 700;
            color: #7a6255;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 10px;
        }
        .error-suggestions ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }
        .error-suggestions ul li a {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            font-weight: 600;
            color: #b17457;
            text-decoration: none;
            padding: 5px 12px;
            border-radius: 50px;
            background: rgba(177,116,87,.08);
            border: 1px solid rgba(177,116,87,.20);
            transition: background .15s, color .15s;
        }
        .error-suggestions ul li a:hover {
            background: #b17457;
            color: #ffffff;
            border-color: #b17457;
        }

        /* Brand name */
        .brand {
            margin-top: 32px;
            font-size: 13px;
            color: #a89080;
        }
        .brand a {
            color: #b17457;
            font-weight: 700;
            text-decoration: none;
        }
        .brand a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="error-wrap">

        <!-- Angka 404 dengan ikon di tengah -->
        <div class="error-code">
            <span class="num">4</span>
            <div class="icon-wrap">
                <i class="fas fa-magnifying-glass"></i>
            </div>
            <span class="num">4</span>
        </div>

        <div class="error-divider"></div>

        <h1 class="error-title">Halaman Tidak Ditemukan</h1>
        <p class="error-desc">
            Oops! Halaman yang kamu cari tidak tersedia.<br>
            Mungkin URL salah atau halaman sudah dipindahkan.
        </p>

        <div class="error-actions">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ url('/dashboard') }}" class="btn-primary-err">
                        <i class="fas fa-gauge-high"></i> Dashboard Admin
                    </a>
                @else
                    <a href="{{ url('/') }}" class="btn-primary-err">
                        <i class="fas fa-house"></i> Kembali ke Beranda
                    </a>
                    <a href="{{ url('/product') }}" class="btn-outline-err">
                        <i class="fas fa-bag-shopping"></i> Lihat Produk
                    </a>
                @endif
            @else
                <a href="{{ url('/') }}" class="btn-primary-err">
                    <i class="fas fa-house"></i> Kembali ke Beranda
                </a>
                <a href="{{ url('/product') }}" class="btn-outline-err">
                    <i class="fas fa-bag-shopping"></i> Lihat Produk
                </a>
            @endauth
        </div>

        <!-- Saran halaman -->
        <div class="error-suggestions">
            <p>Halaman yang mungkin kamu cari</p>
            <ul>
                <li><a href="{{ url('/') }}"><i class="fas fa-house"></i> Beranda</a></li>
                <li><a href="{{ url('/product') }}"><i class="fas fa-bag-shopping"></i> Produk</a></li>
                <li><a href="{{ url('/about') }}"><i class="fas fa-circle-info"></i> Tentang</a></li>
                <li><a href="{{ url('/gallery') }}"><i class="fas fa-images"></i> Galeri</a></li>
                <li><a href="{{ url('/faq') }}"><i class="fas fa-circle-question"></i> FAQ</a></li>
                @auth
                    @if(auth()->user()->role === 'customer')
                        <li><a href="{{ url('/orders') }}"><i class="fas fa-clock-rotate-left"></i> Pesanan</a></li>
                    @endif
                @endauth
            </ul>
        </div>

        <p class="brand">
            &copy; {{ date('Y') }} <a href="{{ url('/') }}">Hema.Indonesia</a>
        </p>
    </div>
</body>
</html>
