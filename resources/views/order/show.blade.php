@extends('template.layout-admin')
@section('title_web', 'Detail Pesanan | Hema.Indonesia')
@section('content-admin')
    @php
        $label = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Dibayar',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
    @endphp
    <div class="page-header">
        <div class="page-title">
            <h4>Detail Pesanan #{{ $data->id }}</h4>
            <h6>Informasi & status pesanan</h6>
        </div>
        <div class="page-btn">
            <a href="{{ url('/order-list') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Produk Dipesan</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Ukuran</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->details as $detail)
                                    <tr>
                                        <td>{{ optional($detail->product)->name ?? 'Produk dihapus' }}</td>
                                        <td class="text-uppercase">{{ $detail->size }}</td>
                                        <td>Rp. {{ number_format($detail->price, 0, ',', '.') }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>Rp. {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total</th>
                                    <th>Rp. {{ number_format($data->total_price, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Informasi Pelanggan</h5>
                    <p class="mb-1"><strong>Nama:</strong> {{ optional($data->user)->first_name }}
                        {{ optional($data->user)->last_name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ optional($data->user)->email }}</p>
                    <p class="mb-1"><strong>No. Telp:</strong> {{ optional($data->user)->no_telp ?? '-' }}</p>
                    <p class="mb-1"><strong>Alamat:</strong> {{ optional($data->user)->address ?? '-' }}</p>
                    <p class="mb-0"><strong>Tanggal:</strong> {{ $data->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Ubah Status</h5>
                    <form action="{{ route('orderStatusPut', $data->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <select class="form-control" name="status">
                                @foreach ($label as $key => $text)
                                    <option value="{{ $key }}" {{ $data->status == $key ? 'selected' : '' }}>
                                        {{ $text }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 w-100">Perbarui Status</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Pengiriman & Pembayaran</h5>
                    <p class="mb-1"><strong>Pembayaran:</strong>
                        {{ $data->payment_type ? ucfirst(str_replace('_', ' ', $data->payment_type)) : '-' }}</p>
                    <p class="mb-3"><strong>Dibayar pada:</strong>
                        {{ $data->paid_at ? $data->paid_at->format('d M Y H:i') : '-' }}</p>
                    <form action="{{ route('orderTrackingPut', $data->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nomor Resi</label>
                            <input type="text" name="tracking_number" value="{{ $data->tracking_number }}"
                                placeholder="Masukkan no. resi" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 w-100">Simpan Resi & Tandai Dikirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
