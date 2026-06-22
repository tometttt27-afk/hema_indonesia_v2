@extends('template.layout-main')
@section('title_web', 'Detail Pesanan | Hema.Indonesia')
@section('content-main')
@php
    $statusBg=['pending'=>'status-pending','paid'=>'status-paid','shipped'=>'status-shipped','completed'=>'status-completed','cancelled'=>'status-cancelled'];
    $statusLabel=['pending'=>'Menunggu Pembayaran','paid'=>'Dibayar','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Dibatalkan'];
@endphp

<div class="page-hero">
    <div class="container">
        <ol class="breadcrumb-list">
            <li><a href="{{ url('/orders') }}">Pesanan</a></li>
            <li>#{{ $data->id }}</li>
        </ol>
        <div class="flex flex-wrap items-center gap-3">
            <h2 class="page-hero mb-0">Pesanan <span style="color:#b17457;">#{{ $data->id }}</span></h2>
            <span class="status-badge {{ $statusBg[$data->status]??'bg-gray-100 text-gray-600' }}">
                {{ $statusLabel[$data->status]??$data->status }}
            </span>
        </div>
        <p>Dibuat {{ $data->created_at->format('d M Y H:i') }}</p>
    </div>
</div>

<section class="container py-14">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Products --}}
        <div class="lg:col-span-2">
            <div class="profile-form-card">
                <h3><i class="fas fa-bag-shopping me-2" style="color:#b17457;"></i>Produk Dipesan</h3>
                <div class="overflow-x-auto">
                    <table class="data-table w-full">
                        <thead><tr><th>Produk</th><th>Ukuran</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr></thead>
                        <tbody>
                            @foreach($data->details as $detail)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <img class="rounded-lg object-cover shrink-0"
                                            style="width:46px;height:46px;border:1px solid #ede3db;"
                                            src="{{ asset('uploads/products/'.optional($detail->product)->image) }}" alt="">
                                        <span class="font-medium text-sm">{{ optional($detail->product)->name ?? 'Produk dihapus' }}</span>
                                    </div>
                                </td>
                                <td class="uppercase text-xs font-bold text-gray-500">{{ $detail->size }}</td>
                                <td>Rp. {{ number_format($detail->price,0,',','.') }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td class="font-bold" style="color:#b17457;">Rp. {{ number_format($detail->price*$detail->quantity,0,',','.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Summary + Actions --}}
        <div>
            <div class="summary-panel mb-5">
                <h3>Ringkasan</h3>
                <div class="summary-row"><span class="label">Total Item</span><span>{{ $data->details->sum('quantity') }}</span></div>
                @if($data->tracking_number)
                <div class="py-3 px-4 rounded-lg mt-3 text-sm" style="background:#f0fdf6;border:1px solid #bbf7d0;">
                    <span class="text-gray-500 text-xs block mb-0.5">No. Resi Pengiriman</span>
                    <strong class="text-gray-800">{{ $data->tracking_number }}</strong>
                </div>
                @endif
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span class="amount">Rp. {{ number_format($data->total_price,0,',','.') }}</span>
                </div>

                @if($data->status==='pending')
                    <a href="{{ route('orderPay',$data->id) }}"
                       class="btn-brand w-full text-center mt-5 py-3 rounded-xl text-sm block">
                        <i class="fas fa-credit-card text-xs"></i> Bayar Sekarang
                    </a>
                @endif

                @if(in_array($data->status,['pending','paid']))
                    <form action="{{ route('orderCancel',$data->id) }}" method="post" class="mt-3">
                        @csrf @method('PUT')
                        <button type="submit" class="btn-danger-soft confirm-text w-full py-3 text-sm rounded-xl text-center">
                            <i class="fas fa-xmark text-xs"></i> Batalkan Pesanan
                        </button>
                    </form>
                @endif

                @if($data->status==='shipped')
                    <form action="{{ route('orderComplete',$data->id) }}" method="post" class="mt-3">
                        @csrf @method('PUT')
                        <button type="submit" class="btn-brand w-full py-3 text-sm rounded-xl text-center block">
                            <i class="fas fa-circle-check text-xs"></i> Pesanan Diterima
                        </button>
                    </form>
                @endif
            </div>

            <a href="{{ url('/orders') }}" class="btn-outline-brand w-full text-center py-3 text-sm rounded-xl block">
                <i class="fas fa-arrow-left text-xs"></i> Kembali ke Pesanan
            </a>
        </div>
    </div>
</section>

@endsection
