<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>403 — Akses Ditolak | Hema.Indonesia</title>
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

        /* Ilustrasi angka 403 */
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
            animation: pulse 2.4s ease-in-out infinite;
        }
        .error-code .icon-wrap i {
            font-size: clamp(30px, 6vw, 48px);
            color: #ffffff;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1);     box-shadow: 0 8px 28px rgba(177,116,87,.35); }
            50%       { transform: scale(1.06);  box-shadow: 0 12px 36px rgba(177,116,87,.50); }
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

        /* Brand name */
        .brand {
            margin-top: 40px;
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

        <!-- Angka 403 dengan ikon di tengah -->
        <div class="error-code">
            <span class="num">4</span>
            <div class="icon-wrap">
                <i class="fas fa-ban"></i>
            </div>
            <span class="num">3</span>
        </div>

        <div class="error-divider"></div>

        <h1 class="error-title">Akses Ditolak</h1>
        <p class="error-desc">
            Maaf, kamu tidak memiliki izin untuk mengakses halaman ini.<br>
            Silakan kembali ke halaman yang sesuai dengan akunmu.
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
                @endif
            @else
                <a href="{{ url('/') }}" class="btn-primary-err">
                    <i class="fas fa-house"></i> Kembali ke Beranda
                </a>
                <a href="{{ url('/auth/sign-in') }}" class="btn-outline-err">
                    <i class="fas fa-right-to-bracket"></i> Masuk
                </a>
            @endauth
        </div>

        <p class="brand">
            &copy; {{ date('Y') }} <a href="{{ url('/') }}">Hema.Indonesia</a>
        </p>
    </div>
</body>
</html>
