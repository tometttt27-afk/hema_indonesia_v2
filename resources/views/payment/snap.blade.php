<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Mengarahkan ke Pembayaran | Hema.Indonesia</title>
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @vite('resources/css/app.css')
</head>
<body class="font-urbanist"
      style="background:linear-gradient(135deg,#1e1410 0%,#3d2e26 100%);
             min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;">

    <div style="max-width:420px;width:100%;">
        <div class="rounded-2xl p-8 text-center"
             style="background:#fff;box-shadow:0 20px 60px rgba(0,0,0,.30);">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="inline-block mb-6 text-xl font-extrabold" style="text-decoration:none;">
                <span style="color:#b17457;">Hema</span><span style="color:#1e1410;">.Indonesia</span>
            </a>

            {{-- Icon pembayaran --}}
            <div class="w-16 h-16 rounded-full mx-auto mb-4 flex items-center justify-center"
                 style="background:linear-gradient(135deg,#b17457,#c29470);">
                <i class="fas fa-credit-card text-white text-2xl"></i>
            </div>

            <h2 class="text-xl font-bold text-gray-900 mb-1">Pembayaran</h2>
            <p class="text-gray-500 text-sm mb-4">Pesanan #{{ $order->id }}</p>

            <div class="rounded-xl py-4 px-6 mb-6"
                 style="background:#faf7f4;border:1.5px solid #ede3db;">
                <p class="text-xs mb-1" style="color:#7a6255;">Total yang harus dibayar</p>
                <p class="text-2xl font-extrabold" style="color:#b17457;">
                    Rp. {{ number_format($order->total_price,0,',','.') }}
                </p>
            </div>

            {{-- Loading indicator --}}
            <div id="loading-state" class="mb-4">
                <div class="flex items-center justify-center gap-2 text-sm" style="color:#7a6255;">
                    <svg class="animate-spin h-4 w-4" style="color:#b17457;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    Membuka halaman pembayaran...
                </div>
            </div>

            <button id="pay-manual"
                    class="w-full py-3 rounded-xl font-bold text-white text-sm mb-3"
                    style="background:linear-gradient(135deg,#b17457,#c29470);border:none;
                           cursor:pointer;transition:opacity .2s;">
                <i class="fas fa-lock me-2"></i> Buka Pembayaran Manual
            </button>

            <a href="{{ url('/orders/'.$order->id) }}"
               style="display:block;text-align:center;font-size:13px;color:#a89080;
                      text-decoration:none;margin-bottom:8px;"
               onmouseover="this.style.color='#7a6255'"
               onmouseout="this.style.color='#a89080'">
                <i class="fas fa-arrow-left text-xs me-1"></i> Kembali ke detail pesanan
            </a>

            <p style="font-size:11px;color:#d1c4bc;margin-top:12px;">
                Jika halaman pembayaran tidak muncul, klik "Buka Pembayaran Manual".
            </p>
        </div>

        <p style="color:rgba(255,255,255,.35);font-size:12px;text-align:center;margin-top:16px;">
            <i class="fas fa-shield-halved me-1"></i>
            Transaksi aman &amp; terenkripsi oleh Midtrans
        </p>
    </div>

    <script type="text/javascript" src="{{ $snapJs }}" data-client-key="{{ $clientKey }}"></script>
    <script>
    var snapToken = '{{ $token }}';
    var orderUrl  = '{{ url('/orders/'.$order->id) }}';

    function openSnap() {
        document.getElementById('loading-state').style.display = 'none';
        window.snap.pay(snapToken, {
            onSuccess: function () { window.location.href = orderUrl; },
            onPending: function () { window.location.href = orderUrl; },
            onError:   function () { window.location.href = orderUrl; },
            onClose:   function () {
                document.getElementById('loading-state').style.display = 'block';
            },
        });
    }

    // Auto-open saat halaman siap
    window.addEventListener('load', openSnap);

    // Tombol manual
    document.getElementById('pay-manual').addEventListener('click', openSnap);
    </script>
</body>
</html>
