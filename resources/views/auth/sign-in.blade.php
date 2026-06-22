<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="success" content="{{ session('success') }}">
    <meta name="error" content="{{ session('error') }}">
    <meta name="errors" content='@json($errors->all())'>
    <title>Masuk | Hema.Indonesia</title>
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
            <h2>Selamat Datang<br>Kembali 👋</h2>
            <p>Masuk untuk melanjutkan perjalanan belanja Anda dan temukan koleksi gamis premium terbaru kami.</p>
        </div>

        <div class="auth-left-features">
            @foreach([
                ['fas fa-bag-shopping','Belanja Mudah & Aman'],
                ['fas fa-truck','Pengiriman ke Seluruh Indonesia'],
                ['far fa-heart','Simpan Produk Favorit'],
                ['fas fa-rotate-left','Garansi Retur 7 Hari'],
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

            <h2>Masuk ke Akun</h2>
            <p class="subtitle">Masukkan email dan kata sandi Anda</p>

            <form action="{{ route('isSignIn') }}" method="post" autocomplete="off">
                @csrf

                <div class="auth-form-group">
                    <label class="auth-label">Email</label>
                    <input class="auth-input" type="email" name="email"
                        placeholder="contoh@email.com" value="{{ old('email') }}">
                </div>

                <div class="auth-form-group">
                    <label class="auth-label">Kata Sandi</label>
                    <div class="auth-input-wrap">
                        <input class="auth-input" type="password" id="password" name="password"
                            placeholder="Masukkan kata sandi">
                        <button type="button" class="auth-eye" onclick="togglePwd('password','eye-pw')">
                            <i class="fas fa-eye-slash" id="eye-pw"></i>
                        </button>
                    </div>
                </div>

                <div class="flex justify-between items-center mb-5" style="font-size:13px;">
                    <label class="flex items-center gap-2 text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember" style="accent-color:#b17457;"> Ingat saya
                    </label>
                    <a href="{{ url('auth/forgot-password') }}" class="auth-link">Lupa kata sandi?</a>
                </div>

                <button type="submit" class="auth-btn">Masuk Sekarang</button>

                <p class="auth-footer-text">
                    Belum punya akun? <a href="{{ url('auth/sign-up') }}" class="auth-link">Daftar</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('library/sweetalert/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/auth.js') }}"></script>
<script src="{{ asset('js/alert.js') }}"></script>
<script>
function togglePwd(id, iconId) {
    const input = document.getElementById(id);
    const icon  = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye-slash','fa-eye');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye','fa-eye-slash');
    }
}
</script>
</body>
</html>
