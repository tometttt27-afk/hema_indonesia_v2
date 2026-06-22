<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="success" content="{{ session('success') }}">
    <meta name="error" content="{{ session('error') }}">
    <meta name="errors" content='@json($errors->all())'>
    <title>Daftar | Hema.Indonesia</title>
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
            <h2>Bergabung dengan<br>Kami Hari Ini ✨</h2>
            <p>Buat akun gratis dan mulai belanja koleksi gamis premium pilihan kami. Ribuan pelanggan sudah bergabung!</p>
        </div>

        <div class="auth-left-features">
            @foreach([
                ['fas fa-gift','Promo Eksklusif Member'],
                ['fas fa-star','Akses Koleksi Terbaru'],
                ['fas fa-shield-halved','Data Aman & Terlindungi'],
                ['fas fa-headset','Layanan Pelanggan 24/7'],
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

            <h2>Buat Akun Baru</h2>
            <p class="subtitle">Isi data diri untuk memulai</p>

            <form action="{{ route('isSignUp') }}" method="post" autocomplete="off">
                @csrf

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div class="auth-form-group" style="margin-bottom:0;">
                        <label class="auth-label">Nama Depan</label>
                        <input class="auth-input" type="text" name="first_name"
                            placeholder="John" value="{{ old('first_name') }}">
                    </div>
                    <div class="auth-form-group" style="margin-bottom:0;">
                        <label class="auth-label">Nama Belakang</label>
                        <input class="auth-input" type="text" name="last_name"
                            placeholder="Doe" value="{{ old('last_name') }}">
                    </div>
                </div>

                <div class="auth-form-group" style="margin-top:18px;">
                    <label class="auth-label">Email</label>
                    <input class="auth-input" type="email" name="email"
                        placeholder="contoh@email.com" value="{{ old('email') }}">
                </div>

                <div class="auth-form-group">
                    <label class="auth-label">Kata Sandi</label>
                    <div class="auth-input-wrap">
                        <input class="auth-input" type="password" id="password" name="password"
                            placeholder="Min. 8 karakter">
                        <button type="button" class="auth-eye" onclick="togglePwd('password','eye-pw')">
                            <i class="fas fa-eye-slash" id="eye-pw"></i>
                        </button>
                    </div>
                    <p style="font-size:11.5px;color:#a89080;margin-top:5px;">
                        Gunakan minimal 8 karakter dengan kombinasi huruf & angka.
                    </p>
                </div>

                <button type="submit" class="auth-btn">Buat Akun</button>

                <p class="auth-footer-text">
                    Sudah punya akun? <a href="{{ url('auth/sign-in') }}" class="auth-link">Masuk</a>
                </p>

                <p style="text-align:center;font-size:11.5px;color:#b8a89e;margin-top:14px;">
                    Dengan mendaftar, Anda menyetujui syarat & ketentuan kami.
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
