@extends('template.layout-admin')
@section('title_web', 'Data Produk | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Data Produk</h4>
        <h6>Kelola seluruh katalog produk</h6>
    </div>
    <a href="{{ url('/product-list/add-product-list') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0 d-flex align-items-center gap-2">
            <i class="bi bi-box-seam-fill" style="color:#b17457;"></i> Daftar Produk
        </h5>
        <span class="badge badge-brand">{{ $data->count() }} produk</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table datanew mb-0">
                <thead><tr>
                    <th>Gambar</th><th>Nama</th><th>Kategori</th>
                    <th>Stok</th><th>Harga</th><th>Ukuran</th><th>Status</th><th>Aksi</th>
                </tr></thead>
                <tbody>
                    @foreach($data as $product)
                    <tr>
                        <td style="width:70px;">
                            <a href="{{ asset('uploads/products/'.$product->image) }}" class="image-popup">
                                <img width="60" height="60" class="rounded"
                                    style="object-fit:cover;border:1.5px solid #ede3db;"
                                    src="{{ asset('uploads/products/'.$product->image) }}" alt="{{ $product->name }}">
                            </a>
                        </td>
                        <td class="fw-600">{{ $product->name }}</td>
                        <td>
                            <span class="badge badge-brand">{{ $product->categories->name }}</span>
                        </td>
                        <td>
                            @if(is_null($product->stock))
                                <span class="text-muted-brand">&infin;</span>
                            @elseif($product->stock<=0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif($product->stock<=5)
                                <span class="badge bg-warning text-dark">{{ $product->stock }} menipis</span>
                            @else
                                <span class="badge bg-success">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-size:12px;color:#7a6255;text-decoration:line-through;">
                                Rp. {{ number_format($product->price,0,',','.') }}
                            </div>
                            @if($product->discount>0)
                                <span class="badge bg-warning text-dark">-{{ $product->discount }}%</span>
                                <strong style="color:#b17457;font-size:13px;">Rp. {{ number_format($product->final_price,0,',','.') }}</strong>
                            @else
                                <strong style="font-size:13px;">Rp. {{ number_format($product->price,0,',','.') }}</strong>
                            @endif
                        </td>
                        <td style="text-transform:uppercase;font-size:12px;color:#7a6255;">{{ $product->size }}</td>
                        <td>
                            <form action="{{ route('productsListStatusPut',$product->code_product) }}" method="post" style="display:inline;">
                                @csrf @method('PUT')
                                <button type="button" class="confirm-status" style="background:transparent;border:none;padding:0;">
                                    <div class="is_active-toggle d-flex align-items-center">
                                        <input type="checkbox" id="tog_{{ $product->code_product }}" class="check" name="is_active" value="1" {{ $product->is_active==1?'checked':'' }}>
                                        <label for="tog_{{ $product->code_product }}" class="checktoggle">checkbox</label>
                                    </div>
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/product-list/edit-product-list/'.strtolower($product->code_product)) }}"
                                    class="btn btn-sm btn-secondary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('productsListDelete',strtolower($product->code_product)) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm confirm-text" type="submit" title="Hapus"
                                        style="background:#fef2f2;border:1px solid #fecaca;color:#ef4444;border-radius:5px;padding:5px 10px;">
                                        <i class="bi bi-trash"></i>
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
