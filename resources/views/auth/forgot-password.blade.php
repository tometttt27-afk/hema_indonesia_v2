<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="success" content="{{ session('success') }}">
    <meta name="error" content="{{ session('error') }}">
    <meta name="errors" content='@json($errors->all())'>
    <title>Lupa Kata Sandi | Hema.Indonesia</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    <link rel="stylesheet" href="{{ asset('library/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
</head>
<body>

<div class="auth-wrapper">

    {{-- ═══ LEFT PANEL ═══ --}}
    <div class="auth-left">
        <a href="{{ url('/') }}" class="auth-left-logo"><span>Hema</span>.Indonesia</a>

        <div class="auth-left-content">
            <h2>Kami Bantu<br>Pulihkan Akun Anda 🔐</h2>
            <p>Jangan khawatir, masukkan email terdaftar dan kami akan kirimkan tautan untuk mengatur ulang kata sandi.</p>
        </div>

        <div class="auth-left-features">
            @foreach([
                ['fas fa-envelope','Link Dikirim via Email'],
                ['fas fa-clock','Berlaku 60 Menit'],
                ['fas fa-shield-halved','Proses Aman & Terenkripsi'],
                ['fas fa-headset','Butuh Bantuan? Hubungi Kami'],
            ] as $f)
            <div class="auth-left-feature">
                <span class="auth-left-feature-icon"><i class="{{ $f[0] }}"></i></span>
                {{ $f[1] }}
            </div>
            @endforeach
        </div>
    </div>

    {{-- ═══ RIGHT PANEL ═══ --}}
    <div class="auth-right">
        <div class="auth-card">

            <a href="{{ url('/') }}" class="auth-card-logo"><span>Hema</span>.Indonesia</a>

            {{-- Icon --}}
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center"
                    style="background:rgba(177,116,87,.1);">
                    <i class="fas fa-envelope text-3xl" style="color:#b17457;"></i>
                </div>
            </div>

            <h2>Lupa Kata Sandi?</h2>
            <p class="subtitle">Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.</p>

            <form action="{{ route('forgotPasswordPost') }}" method="post" autocomplete="off">
                @csrf

                <div class="auth-form-group">
                    <label class="auth-label">Alamat Email</label>
                    <input class="auth-input" type="email" name="email"
                        placeholder="contoh@email.com" value="{{ old('email') }}">
                </div>

                <button type="submit" class="auth-btn">
                    <i class="fas fa-paper-plane me-2 text-sm"></i>Kirim Tautan Reset
                </button>

                <p class="auth-footer-text">
                    Ingat kata sandi? <a href="{{ url('auth/sign-in') }}" class="auth-link">Kembali Masuk</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('library/sweetalert/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/auth.js') }}"></script>
<script src="{{ asset('js/alert.js') }}"></script>
</body>
</html>
