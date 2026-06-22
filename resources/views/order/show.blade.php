@extends('template.layout-admin')
@section('title_web', 'Detail Pesanan | Hema.Indonesia')
@section('content-admin')
    @php
        $badgeClass = [
            'pending'   => 'bg-warning text-dark',
            'paid'      => 'bg-info text-white',
            'shipped'   => 'bg-primary',
            'completed' => 'bg-success',
            'cancelled' => 'bg-danger',
        ];
        $label = [
            'pending'   => 'Menunggu Pembayaran',
            'paid'      => 'Dibayar',
            'shipped'   => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];
    @endphp
    <div class="page-header">
        <div class="page-title">
            <h4>Detail Pesanan <span style="color:#b17457;">#{{ $data->id }}</span></h4>
            <h6>
                <span class="badge {{ $badgeClass[$data->status] ?? 'bg-secondary' }}">
                    {{ $label[$data->status] ?? $data->status }}
                </span>
                &nbsp;{{ $data->created_at->format('d M Y H:i') }}
            </h6>
        </div>
        <div class="page-btn">
            <a href="{{ url('/order-list') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-shopping-bag me-2" style="color:#b17457;"></i>Produk Dipesan</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
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
                                        <td class="text-uppercase">
                                            <span class="badge" style="background:#f3ede9;color:#b17457;border:1px solid #e8ddd7;">{{ $detail->size }}</span>
                                        </td>
                                        <td>Rp. {{ number_format($detail->price, 0, ',', '.') }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td><strong>Rp. {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr style="background:#faf7f5;">
                                    <th colspan="4" class="text-end">Total</th>
                                    <th style="color:#b17457;">Rp. {{ number_format($data->total_price, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- Info Pelanggan --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-user me-2" style="color:#b17457;"></i>Pelanggan</h5>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Nama:</strong> {{ optional($data->user)->first_name }} {{ optional($data->user)->last_name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ optional($data->user)->email }}</p>
                    <p class="mb-1"><strong>No. Telp:</strong> {{ optional($data->user)->no_telp ?? '-' }}</p>
                    <p class="mb-0"><strong>Alamat:</strong> {{ optional($data->user)->address ?? '-' }}</p>
                </div>
            </div>

            {{-- Ubah Status --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-rotate me-2" style="color:#b17457;"></i>Ubah Status</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('orderStatusPut', $data->id) }}" method="post">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label>Status Pesanan</label>
                            <select class="form-control" name="status">
                                @foreach ($label as $key => $text)
                                    <option value="{{ $key }}" {{ $data->status == $key ? 'selected' : '' }}>{{ $text }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Perbarui Status</button>
                    </form>
                </div>
            </div>

            {{-- Pengiriman --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-truck me-2" style="color:#b17457;"></i>Pengiriman</h5>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Metode:</strong> {{ $data->payment_type ? ucfirst(str_replace('_', ' ', $data->payment_type)) : '-' }}</p>
                    <p class="mb-3"><strong>Dibayar:</strong> {{ $data->paid_at ? $data->paid_at->format('d M Y H:i') : '-' }}</p>
                    <form action="{{ route('orderTrackingPut', $data->id) }}" method="post">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label>Nomor Resi</label>
                            <input type="text" name="tracking_number" value="{{ $data->tracking_number }}" placeholder="Masukkan no. resi" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Simpan Resi &amp; Tandai Dikirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
