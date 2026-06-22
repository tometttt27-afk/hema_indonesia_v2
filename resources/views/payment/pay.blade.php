<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran | Hema.Indonesia</title>
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="font-urbanist bg-[#f5f5f5]">
    <section class="container w-full h-dvh flex justify-center items-center">
        <main class="bg-white p-8 rounded shadow w-full md:w-1/2 xl:w-1/3 text-center">
            <h1 class="text-xl md:text-2xl font-bold mb-2"><span class="text-primary">Hema</span>.Indonesia</h1>
            <p class="text-gray-500 text-sm mb-1">Pembayaran Pesanan #{{ $order->id }}</p>
            <p class="text-lg font-semibold text-primary mb-6">Rp.
                {{ number_format($order->total_price, 0, ',', '.') }}</p>

            <button id="pay-button"
                class="w-full bg-gradient-to-r from-primary to-secondary text-white text-sm font-medium rounded-sm py-[12px] hover:opacity-90">
                Bayar Sekarang
            </button>
            <a href="{{ url('/orders/' . $order->id) }}"
                class="block mt-3 text-sm text-gray-500 hover:text-primary">Kembali ke detail pesanan</a>
            <p class="text-[11px] text-gray-400 mt-4">Jika jendela pembayaran tidak muncul, klik tombol "Bayar Sekarang".
            </p>
        </main>
    </section>

    <script type="text/javascript" src="{{ $snapJs }}" data-client-key="{{ $clientKey }}"></script>
    <script type="text/javascript">
        const payButton = document.getElementById('pay-button');

        function startPayment() {
            window.snap.pay('{{ $token }}', {
                onSuccess: function() {
                    window.location.href = '{{ url('/orders/' . $order->id) }}';
                },
                onPending: function() {
                    window.location.href = '{{ url('/orders/' . $order->id) }}';
                },
                onError: function() {
                    window.location.href = '{{ url('/orders/' . $order->id) }}';
                },
                onClose: function() {
                    window.location.href = '{{ url('/orders/' . $order->id) }}';
                }
            });
        }

        payButton.addEventListener('click', startPayment);
        // buka otomatis saat halaman siap
        window.addEventListener('load', startPayment);
    </script>
</body>

</html>
