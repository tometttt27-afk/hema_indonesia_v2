<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="success" content="{{ session('success') }}">
    <meta name="error" content="{{ session('error') }}">
    <meta name="errors" content='@json($errors->all())'>
    <title>Reset Kata Sandi | Hema.Indonesia</title>
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
            <h2>Buat Kata Sandi<br>Baru yang Kuat 🛡️</h2>
            <p>Pastikan kata sandi baru Anda kuat dan tidak mudah ditebak. Kombinasikan huruf, angka, dan simbol.</p>
        </div>

        <div class="auth-left-features">
            @foreach([
                ['fas fa-lock','Gunakan Min. 8 Karakter'],
                ['fas fa-font','Kombinasi Huruf Besar & Kecil'],
                ['fas fa-hashtag','Tambahkan Angka & Simbol'],
                ['fas fa-ban','Hindari Kata Sandi Umum'],
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
                    <i class="fas fa-key text-3xl" style="color:#b17457;"></i>
                </div>
            </div>

            <h2>Reset Kata Sandi</h2>
            <p class="subtitle">Masukkan kata sandi baru untuk akun Anda.</p>

            <form action="{{ route('resetPasswordPost') }}" method="post" autocomplete="off">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="auth-form-group">
                    <label class="auth-label">Email</label>
                    <input class="auth-input" type="email" name="email"
                        placeholder="contoh@email.com" value="{{ old('email', $email) }}">
                </div>

                <div class="auth-form-group">
                    <label class="auth-label">Kata Sandi Baru</label>
                    <div class="auth-input-wrap">
                        <input class="auth-input" type="password" id="password" name="password"
                            placeholder="Min. 8 karakter">
                        <button type="button" class="auth-eye" onclick="togglePwd('password','eye-pw')">
                            <i class="fas fa-eye-slash" id="eye-pw"></i>
                        </button>
                    </div>
                </div>

                <div class="auth-form-group">
                    <label class="auth-label">Konfirmasi Kata Sandi Baru</label>
                    <div class="auth-input-wrap">
                        <input class="auth-input" type="password" id="password_confirmation"
                            name="password_confirmation" placeholder="Ulangi kata sandi baru">
                        <button type="button" class="auth-eye" onclick="togglePwd('password_confirmation','eye-pc')">
                            <i class="fas fa-eye-slash" id="eye-pc"></i>
                        </button>
                    </div>
                </div>

                {{-- Strength indicator --}}
                <div id="strength-wrap" class="mb-4" style="display:none;">
                    <div style="height:4px;border-radius:4px;background:#ede3db;overflow:hidden;">
                        <div id="strength-bar" style="height:100%;width:0;transition:width .3s,background .3s;border-radius:4px;"></div>
                    </div>
                    <p id="strength-text" style="font-size:11.5px;margin-top:4px;color:#7a6255;"></p>
                </div>

                <button type="submit" class="auth-btn">
                    <i class="fas fa-shield-halved me-2 text-sm"></i>Simpan Kata Sandi Baru
                </button>

                <p class="auth-footer-text">
                    <a href="{{ url('auth/sign-in') }}" class="auth-link">
                        <i class="fas fa-arrow-left text-xs me-1"></i>Kembali ke halaman masuk
                    </a>
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

// Password strength meter
document.getElementById('password').addEventListener('input', function() {
    const val = this.value;
    const wrap = document.getElementById('strength-wrap');
    const bar  = document.getElementById('strength-bar');
    const text = document.getElementById('strength-text');
    if (!val) { wrap.style.display='none'; return; }
    wrap.style.display = 'block';
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    const levels = [
        ['25%','#ef4444','Sangat Lemah'],
        ['50%','#f59e0b','Lemah'],
        ['75%','#3b82f6','Cukup Kuat'],
        ['100%','#22c55e','Sangat Kuat'],
    ];
    const lv = levels[score-1] || levels[0];
    bar.style.width   = lv[0];
    bar.style.background = lv[1];
    text.textContent  = lv[2];
    text.style.color  = lv[1];
});
</script>
</body>
</html>
