@extends('template.layout-main')
@section('title_web', 'Checkout | Hema.Indonesia')
@section('content-main')

<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list">
            <li><a href="{{ url('/cart') }}">Keranjang</a></li>
            <li>Checkout</li>
        </ol>
        <h2 class="page-hero">Checkout <span style="color:#b17457;">Pesanan</span></h2>
        <p>Periksa kembali pesanan sebelum konfirmasi</p>
    </div>
</div>

<section class="container py-14">

    {{-- Step indicator --}}
    <div class="flex items-center justify-center gap-2 mb-10">
        @foreach([['1','Keranjang','cart'],['2','Checkout','checkout'],['3','Pembayaran','payment']] as $i => $step)
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold
                {{ $step[0]=='2' ? 'text-white' : 'text-gray-400 bg-gray-100' }}"
                style="{{ $step[0]=='2' ? 'background:linear-gradient(135deg,#b17457,#c29470);' : '' }}">
                {{ $step[0] }}
            </div>
            <span class="text-sm font-medium {{ $step[0]=='2' ? 'text-gray-800' : 'text-gray-400' }}">{{ $step[1] }}</span>
        </div>
        @if($i < 2)
            <div class="w-12 h-px bg-gray-200 mx-1"></div>
        @endif
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 flex flex-col gap-6">

            {{-- Shipping address --}}
            <div class="profile-form-card">
                <h3>
                    <i class="fas fa-location-dot me-2" style="color:#b17457;"></i>Alamat Pengiriman
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3" style="font-size:14px;">
                    @foreach([
                        ['Nama', $user->first_name.' '.$user->last_name],
                        ['Email', $user->email],
                        ['No. Telp', $user->no_telp ?? '-'],
                    ] as $row)
                    <div class="flex gap-2">
                        <span class="font-semibold text-gray-500 shrink-0" style="min-width:64px;">{{ $row[0] }}</span>
                        <span class="text-gray-800">{{ $row[1] }}</span>
                    </div>
                    @endforeach
                    <div class="flex gap-2 md:col-span-2">
                        <span class="font-semibold text-gray-500 shrink-0" style="min-width:64px;">Alamat</span>
                        <span class="text-gray-800">{{ $user->address ?? '-' }}</span>
                    </div>
                </div>
                @if(empty($user->address) || empty($user->no_telp))
                    <div class="mt-4 flex items-start gap-2 p-3 rounded-lg" style="background:#fef9c3;border:1px solid #fde68a;">
                        <i class="fas fa-triangle-exclamation text-amber-500 mt-0.5"></i>
                        <p class="text-sm text-amber-700">
                            Lengkapi alamat & no. telepon di
                            <a href="{{ url('/profile') }}" class="font-semibold underline">halaman profil</a>.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Products --}}
            <div class="profile-form-card">
                <h3><i class="fas fa-bag-shopping me-2" style="color:#b17457;"></i>Ringkasan Produk</h3>
                <div class="overflow-x-auto">
                    <table class="data-table w-full">
                        <thead><tr><th>Produk</th><th>Ukuran</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr></thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <img class="rounded-lg object-cover shrink-0"
                                            style="width:44px;height:44px;border:1px solid #ede3db;"
                                            src="{{ asset('uploads/products/'.$item['image']) }}" alt="">
                                        <span class="font-medium text-sm text-gray-800">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td class="uppercase text-xs font-bold text-gray-500">{{ $item['size'] }}</td>
                                <td>Rp. {{ number_format($item['price'],0,',','.') }}</td>
                                <td>{{ $item['qty'] }}</td>
                                <td class="font-bold" style="color:#b17457;">Rp. {{ number_format($item['price']*$item['qty'],0,',','.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Order summary --}}
        <div>
            <div class="summary-panel">
                <h3>Total Pembayaran</h3>
                <div class="summary-row"><span class="label">Total Item</span><span>{{ collect($cart)->sum('qty') }}</span></div>
                <div class="summary-row"><span class="label">Pengiriman</span><span class="text-xs text-gray-400">Gratis</span></div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span class="amount">Rp. {{ number_format($total,0,',','.') }}</span>
                </div>

                @php
                    $missingFields = [];
                    if (empty($user->no_telp))  $missingFields[] = 'No. Telepon';
                    if (empty($user->address))  $missingFields[] = 'Alamat Lengkap';
                    $canCheckout = empty($missingFields);
                @endphp

                @if($canCheckout)
                    {{-- Data lengkap — form normal --}}
                    <form action="{{ route('orderStore') }}" method="post" class="mt-5">
                        @csrf
                        <button type="submit" class="btn-brand w-full py-3 text-sm text-center block rounded-xl">
                            <i class="fas fa-check-circle text-xs"></i> Konfirmasi Pesanan
                        </button>
                    </form>
                @else
                    {{-- Data belum lengkap — tombol dicegat oleh JS --}}
                    <div class="mt-5">
                        <button type="button"
                                id="btn-checkout-blocked"
                                class="btn-brand w-full py-3 text-sm text-center block rounded-xl"
                                data-missing="{{ implode(' dan ', $missingFields) }}"
                                style="opacity:.7;cursor:not-allowed;">
                            <i class="fas fa-lock text-xs"></i> Konfirmasi Pesanan
                        </button>
                    </div>
                @endif

                <p class="text-xs text-gray-400 text-center mt-3">
                    Pesanan dibuat dengan status "Menunggu Pembayaran".
                </p>
            </div>
        </div>
    </div>
</section>

@if(!$canCheckout)
<script>
document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('btn-checkout-blocked');
    if (!btn) return;

    var missing = btn.getAttribute('data-missing');

    // Tampilkan SweetAlert otomatis saat halaman dimuat
    Swal.fire({
        title          : 'Profil Belum Lengkap',
        html           : '<p>Harap lengkapi <strong>' + missing + '</strong> terlebih dahulu sebelum melanjutkan konfirmasi pesanan.</p>',
        icon           : 'warning',
        confirmButtonText: 'Lengkapi Profil',
        showCancelButton : true,
        cancelButtonText : 'Nanti Saja',
        reverseButtons   : true,
        customClass    : {
            confirmButton: 'btn-brand',
            cancelButton : 'btn-outline-brand',
            popup        : 'swal-brand-popup',
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.isConfirmed) {
            window.location.href = '{{ url('/profile') }}';
        }
    });

    // Klik tombol yang diblokir → tampilkan SweetAlert lagi
    btn.addEventListener('click', function () {
        Swal.fire({
            title          : 'Profil Belum Lengkap',
            html           : '<p>Harap lengkapi <strong>' + missing + '</strong> di halaman profil sebelum melanjutkan konfirmasi pesanan.</p>'
                           + '<p style="margin-top:10px;font-size:13px;color:#7a6255;">Pesanan tidak dapat dibuat tanpa informasi pengiriman yang lengkap.</p>',
            icon           : 'warning',
            confirmButtonText: '<i class="fas fa-user me-2"></i>Lengkapi Profil Sekarang',
            showCancelButton : true,
            cancelButtonText : 'Batal',
            reverseButtons   : true,
            customClass    : {
                confirmButton: 'btn-brand',
                cancelButton : 'btn-outline-brand',
                popup        : 'swal-brand-popup',
            },
            buttonsStyling: false,
        }).then(function (result) {
            if (result.isConfirmed) {
                window.location.href = '{{ url('/profile') }}';
            }
        });
    });
});
</script>
<style>
.swal-brand-popup { font-family: "Urbanist", sans-serif !important; border-radius: 14px !important; }
.swal-brand-popup .swal2-title { font-family: "Urbanist", sans-serif !important; font-weight: 800; color: #1e1410; }
.swal-brand-popup .swal2-html-container { font-family: "Urbanist", sans-serif !important; color: #7a6255; }
</style>
@endif

@endsection
