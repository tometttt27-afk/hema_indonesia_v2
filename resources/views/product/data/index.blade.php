@extends('template.layout-admin')
@section('title_web', 'Data Produk | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Data Produk</h4>
            <h6>Kelola seluruh data produk</h6>
        </div>
        <div class="page-btn">
            <a href="{{ url('/product-list/add-product-list') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Ukuran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $product)
                            <tr>
                                <td>
                                    <a href="{{ asset('uploads/products/' . $product->image) }}" class="image-popup">
                                        <img width="70" height="60" class="img-fluid rounded"
                                            style="object-fit:cover;"
                                            src="{{ asset('uploads/products/' . $product->image) }}"
                                            alt="{{ $product->name }}">
                                    </a>
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->categories->name }}</td>
                                <td>
                                    @if (is_null($product->stock))
                                        <span class="text-muted">&infin;</span>
                                    @elseif ($product->stock <= 0)
                                        <span class="badge bg-danger">Habis</span>
                                    @elseif ($product->stock <= 5)
                                        <span class="badge bg-warning text-dark">{{ $product->stock }} (menipis)</span>
                                    @else
                                        <span class="badge bg-success">{{ $product->stock }}</span>
                                    @endif
                                </td>
                                <td>
                                    <p class="mb-1 text-muted" style="font-size:12px;">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                                    @if ($product->discount > 0)
                                        <span class="badge bg-warning text-dark me-1">-{{ $product->discount }}%</span>
                                        <strong style="color:#b17457;">Rp. {{ number_format($product->final_price, 0, ',', '.') }}</strong>
                                    @else
                                        <strong>Rp. {{ number_format($product->price, 0, ',', '.') }}</strong>
                                    @endif
                                </td>
                                <td style="text-transform:uppercase;font-size:12px;">{{ $product->size }}</td>
                                <td>
                                    <form action="{{ route('productsListStatusPut', $product->code_product) }}" method="post" style="display:inline;">
                                        @csrf @method('PUT')
                                        <button type="button" class="confirm-status" style="background:transparent;border:none;padding:0;">
                                            <div class="is_active-toggle d-flex align-items-center">
                                                <input type="checkbox" id="toggle_{{ $product->code_product }}" class="check" name="is_active" value="1" {{ $product->is_active == 1 ? 'checked' : '' }}>
                                                <label for="toggle_{{ $product->code_product }}" class="checktoggle">checkbox</label>
                                            </div>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ url('/product-list/edit-product-list/' . strtolower($product->code_product)) }}"
                                            class="btn btn-sm" style="background:#f3ede9;border:1px solid #e8ddd7;" title="Edit">
                                            <i class="bi bi-pencil" style="color:#b17457;"></i>
                                        </a>
                                        <form action="{{ route('productsListDelete', strtolower($product->code_product)) }}" method="post">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm confirm-text" style="background:#fdf2f2;border:1px solid #f5c6cb;" title="Hapus" type="submit">
                                                <i class="bi bi-trash" style="color:#dc3545;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
