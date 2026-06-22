@extends('template.layout-admin')
@section('title_web', 'Ubah Produk | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Ubah Data Produk</h4>
        <h6>Mengubah informasi produk</h6>
    </div>
    <a href="{{ url('/product-list') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<form action="{{ route('productsListPut', $data->code_product) }}" method="post" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="bi bi-pencil-square me-2" style="color:#b17457;"></i>Informasi Produk</h5>
                    <span class="badge badge-brand">{{ $data->code_product }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $data->name }}" name="name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kode Produk</label>
                                <input type="text" value="{{ $data->code_product }}" readonly name="code_product"
                                    style="background:#f5f5f5;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Harga <span class="text-danger">*</span></label>
                                <input type="number" value="{{ $data->price }}" name="price" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Diskon (%)</label>
                                <input type="number" value="{{ $data->discount }}" name="discount" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Stok <span class="text-danger">*</span></label>
                                <input type="number" value="{{ $data->stock }}" name="stock" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select class="js-example-basic-single select2" name="category_id" id="js-example-basic-single">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id==$data->category_id?'selected':'' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Ukuran <span class="text-danger">*</span></label>
                                @php $sizes = $data->size ? explode(', ',$data->size) : []; @endphp
                                <select name="size[]" class="form-control basic tagging" multiple="multiple">
                                    @foreach(['xs','s','m','l','xl','xxl','xxxl','custom'] as $sz)
                                        <option value="{{ $sz }}" {{ in_array($sz,$sizes)?'selected':'' }}>{{ strtoupper($sz) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="select" name="is_active">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="1" {{ $data->is_active=='1'?'selected':'' }}>Aktif</option>
                                    <option value="0" {{ $data->is_active=='0'?'selected':'' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Deskripsi</label>
                                <textarea name="description" rows="5" class="form-control">{{ $data->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="bi bi-image me-2" style="color:#b17457;"></i>Foto Produk</h5>
                </div>
                <div class="card-body">
                    @if($data->image)
                        <img src="{{ asset('uploads/products/'.$data->image) }}" alt="foto"
                            class="rounded mb-3 w-100" style="max-height:180px;object-fit:cover;border:1.5px solid #ede3db;">
                    @endif
                    <div class="image-upload">
                        <input name="image" id="file_drop" type="file" onchange="updateFileName()">
                        <div class="image-uploads" id="upload-area">
                            <img src="{{ asset('admin/img/icons/upload.svg') }}" alt="Upload" style="width:40px;opacity:.5;">
                            <h4 id="file-name" style="font-size:12px;color:#7a6255;margin-top:6px;">Ganti foto (opsional)</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                    </button>
                    <button type="reset" class="btn btn-cancel w-100">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
