<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Pembayaran | Hema.Indonesia</title>
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @vite('resources/css/app.css')
</head>
<body class="font-urbanist" style="background:linear-gradient(135deg,#1e1410 0%,#3d2e26 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;">

    <div class="text-center px-4" style="max-width:420px;width:100%;">
        {{-- Card --}}
        <div class="rounded-2xl p-8" style="background:#fff;box-shadow:0 20px 60px rgba(0,0,0,.3);">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="inline-block mb-6 text-xl font-extrabold">
                <span style="color:#b17457;">Hema</span><span class="text-gray-800">.Indonesia</span>
            </a>

            {{-- Status indicator --}}
            <div class="w-16 h-16 rounded-full mx-auto mb-4 flex items-center justify-center"
                style="background:linear-gradient(135deg,#b17457,#c29470);">
                <i class="fas fa-credit-card text-white text-2xl"></i>
            </div>

            <h2 class="text-xl font-bold text-gray-900 mb-1">Pembayaran Pesanan</h2>
            <p class="text-gray-500 text-sm mb-4">Pesanan #{{ $order->id }}</p>

            <div class="rounded-xl py-4 px-6 mb-6" style="background:#faf7f4;border:1.5px solid #ede3db;">
                <p class="text-xs text-gray-500 mb-1">Total yang harus dibayar</p>
                <p class="text-2xl font-extrabold" style="color:#b17457;">
                    Rp. {{ number_format($order->total_price,0,',','.') }}
                </p>
            </div>

            <button id="pay-button"
                class="w-full py-4 rounded-xl font-bold text-white text-sm mb-3"
                style="background:linear-gradient(135deg,#b17457,#c29470);border:none;cursor:pointer;transition:opacity .2s;"
                onmouseover="this.style.opacity='.88'" onmouseout="this.style.opacity='1'">
                <i class="fas fa-lock me-2"></i> Bayar Sekarang
            </button>

            <a href="{{ url('/orders/'.$order->id) }}"
               class="block text-sm text-gray-400 hover:text-gray-600 transition-colors"
               style="text-decoration:none;">
                <i class="fas fa-arrow-left me-1 text-xs"></i> Kembali ke detail pesanan
            </a>

            <p class="text-xs text-gray-300 mt-5">
                Jika jendela pembayaran tidak muncul, klik "Bayar Sekarang" kembali.
            </p>
        </div>

        {{-- Security note --}}
        <p class="text-white/40 text-xs mt-4">
            <i class="fas fa-shield-halved me-1"></i>
            Transaksi aman & terenkripsi oleh Midtrans
        </p>
    </div>

    <script type="text/javascript" src="{{ $snapJs }}" data-client-key="{{ $clientKey }}"></script>
    <script>
    function startPayment() {
        window.snap.pay('{{ $token }}', {
            onSuccess: () => { window.location.href = '{{ url('/orders/'.$order->id) }}'; },
            onPending: () => { window.location.href = '{{ url('/orders/'.$order->id) }}'; },
            onError:   () => { window.location.href = '{{ url('/orders/'.$order->id) }}'; },
            onClose:   () => { window.location.href = '{{ url('/orders/'.$order->id) }}'; },
        });
    }
    document.getElementById('pay-button').addEventListener('click', startPayment);
    window.addEventListener('load', startPayment);
    </script>
</body>
</html>
