@extends('template.layout-admin')
@section('title_web', 'Data Produk | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Data Produk</h4>
            <h6>View/Search produk</h6>
        </div>
        <div class="page-btn">
            <a href="{{ url('/product-list/add-product-list') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah produk
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{ asset('admin/img/icons/filter.svg') }}" alt="img">
                            <span><img src="{{ asset('admin/img/icons/closes.svg') }}" alt="img"></span>
                        </a>
                    </div>
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('admin/img/icons/search-white.svg') }}"
                                alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="{{ asset('admin/img/icons/pdf.svg') }}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{ asset('admin/img/icons/excel.svg') }}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="{{ asset('admin/img/icons/printer.svg') }}" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select">
                                    <option>Choose Category</option>
                                    <option>Computers</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select">
                                    <option>Choose Sub Category</option>
                                    <option>Fruits</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select">
                                    <option>Choose Sub Brand</option>
                                    <option>Iphone</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                            <div class="form-group">
                                <a class="btn btn-filters ms-auto"><img
                                        src="{{ asset('admin/img/icons/search-whites.svg') }}" alt="img"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ukuran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $product)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>
                                    <img width="85px" height="70px"
                                        src="{{ asset('uploads/products/' . $product->image) }}"
                                        alt="{{ $product->code_product }}">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->categories->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->size }}</td>
                                <td>
                                    <form style="padding: 0; display: flex;"
                                        action="{{ route('productsListStatusPut', $product->code_product) }}"
                                        method="post">
                                        @csrf
                                        @method('PUT')
                                        <button style="background: transparent; padding: 0; border: none; outline: none"
                                            type="button" class="confirm-status">
                                            <div class="is_active-toggle d-flex justify-content-between align-items-center">
                                                <input type="checkbox" id="is_active_checkbox_{{ $product->code_product }}"
                                                    class="check" name="is_active" value="1"
                                                    {{ $product->is_active == 1 ? 'checked' : '' }}>
                                                <label for="is_active_checkbox_{{ $product->code_product }}"
                                                    class="checktoggle">checkbox</label>
                                            </div>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; ">
                                        <a class="me-3"
                                            href="{{ url('/product-list/edit-product-list/' . strtolower($product->code_product)) }}">
                                            <img src="{{ asset('admin/img/icons/edit.svg') }}" alt="img">
                                        </a>
                                        <form
                                            action="{{ route('productsListDelete', strtolower($product->code_product)) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="me-3 confirm-text"
                                                style="background: transparent; padding: 0; border: none; outline: none"
                                                type="submit">
                                                <img src="{{ asset('admin/img/icons/delete.svg') }}"
                                                    alt="img"></button>
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

    </div>
@endsection
