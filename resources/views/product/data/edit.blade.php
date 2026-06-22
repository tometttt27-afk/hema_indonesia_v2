@extends('template.layout-admin')
@section('title_web', 'Edit Produk | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <h4>Edit Produk</h4>
        <h6>Perubahan akan langsung diperbarui di database dan halaman katalog customer</h6>
    </div>
    <a href="{{ url('/product-list') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

{{-- ── Validation errors summary ── --}}
@if($errors->any())
<div class="alert alert-danger d-flex align-items-start gap-3 mb-4">
    <i class="bi bi-exclamation-triangle-fill flex-shrink-0 mt-1"></i>
    <div>
        <strong>Terdapat {{ $errors->count() }} kesalahan. Periksa kembali form di bawah:</strong>
        <ul class="mb-0 mt-1 ps-3">
            @foreach($errors->all() as $error)
                <li style="font-size:13px;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

{{--
    ACTION  : PUT /product-list/edit-product-list/{code_product}
    METHOD  : POST + @method('PUT') → Laravel baca sebagai PUT
    ENCTYPE : multipart/form-data  → wajib agar file upload berjalan
    Semua field di bawah langsung dikirim ke productsListUpdate()
    yang memanggil $product->update([...]) ke tabel 'products'.
--}}
<form action="{{ route('productsListPut', $data->code_product) }}"
      method="POST"
      enctype="multipart/form-data"
      id="form-edit-product"
      novalidate>
    @csrf
    @method('PUT')

    <div class="row g-3">

        {{-- ════════════════════════════════════════════════
             KOLOM KIRI — Info produk
        ════════════════════════════════════════════════ --}}
        <div class="col-lg-8">

            {{-- Card 1: Identitas --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-tag me-2" style="color:#b17457;"></i>Identitas Produk
                    </h5>
                    <span class="badge badge-brand">{{ $data->code_product }}</span>
                </div>
                <div class="card-body">
                    <div class="row">

                        {{-- Nama --}}
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Nama Produk <span class="text-danger">*</span></label>
                                <input type="text"
                                       name="name"
                                       id="inp-name"
                                       value="{{ old('name', $data->name) }}"
                                       autocomplete="off"
                                       class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                                @error('name')
                                    <div style="font-size:12px;color:#dc2626;margin-top:4px;">
                                        <i class="bi bi-x-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Kode (readonly) --}}
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Kode Produk</label>
                                <input type="text"
                                       name="code_product"
                                       value="{{ $data->code_product }}"
                                       readonly
                                       style="background:#f8f6f3;cursor:not-allowed;color:#7a6255;">
                                <small style="font-size:11px;color:#a89080;margin-top:3px;display:block;">
                                    Kode tidak dapat diubah
                                </small>
                            </div>
                        </div>

                        {{-- Kategori --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select name="category_id"
                                        class="js-example-basic-single select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                                    <option value="">— Pilih Kategori —</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('category_id', $data->category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div style="font-size:12px;color:#dc2626;margin-top:4px;">
                                        <i class="bi bi-x-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Ukuran --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Ukuran Tersedia <span class="text-danger">*</span></label>
                                @php
                                    // Ambil dari old() saat validasi gagal, fallback ke DB
                                    $currentSizes = old('size', $data->sizes_array);
                                @endphp
                                <select name="size[]"
                                        class="form-control basic tagging {{ $errors->has('size') ? 'is-invalid' : '' }}"
                                        multiple="multiple">
                                    @foreach(['xs','s','m','l','xl','xxl','xxxl','custom'] as $sz)
                                        <option value="{{ $sz }}"
                                            {{ in_array($sz, $currentSizes) ? 'selected' : '' }}>
                                            {{ strtoupper($sz) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('size')
                                    <div style="font-size:12px;color:#dc2626;margin-top:4px;">
                                        <i class="bi bi-x-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Deskripsi Produk <span class="text-danger">*</span></label>
                                <textarea name="description"
                                          rows="5"
                                          placeholder="Jelaskan detail produk: bahan, keunggulan, petunjuk perawatan..."
                                          class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $data->description) }}</textarea>
                                @error('description')
                                    <div style="font-size:12px;color:#dc2626;margin-top:4px;">
                                        <i class="bi bi-x-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Card 2: Harga & Stok --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-cash-stack me-2" style="color:#b17457;"></i>Harga &amp; Stok
                    </h5>
                    {{-- Live preview harga akhir --}}
                    <div id="price-preview"
                         style="font-size:13px;font-weight:700;color:#b17457;
                                padding:5px 12px;background:#faf0ea;
                                border-radius:6px;display:none;">
                        Harga akhir: <span id="price-preview-val">—</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        {{-- Harga --}}
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Harga (Rp) <span class="text-danger">*</span></label>
                                <input type="number"
                                       name="price"
                                       id="inp-price"
                                       value="{{ old('price', $data->price) }}"
                                       min="0" step="100"
                                       autocomplete="off"
                                       class="{{ $errors->has('price') ? 'is-invalid' : '' }}">
                                @error('price')
                                    <div style="font-size:12px;color:#dc2626;margin-top:4px;">
                                        <i class="bi bi-x-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Diskon --}}
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Diskon (%)</label>
                                <input type="number"
                                       name="discount"
                                       id="inp-discount"
                                       value="{{ old('discount', $data->discount) }}"
                                       min="0" max="100" step="1"
                                       autocomplete="off"
                                       class="{{ $errors->has('discount') ? 'is-invalid' : '' }}">
                                @error('discount')
                                    <div style="font-size:12px;color:#dc2626;margin-top:4px;">
                                        <i class="bi bi-x-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Stok --}}
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Stok <span class="text-danger">*</span></label>
                                <input type="number"
                                       name="stock"
                                       id="inp-stock"
                                       value="{{ old('stock', $data->stock) }}"
                                       min="0" step="1"
                                       autocomplete="off"
                                       class="{{ $errors->has('stock') ? 'is-invalid' : '' }}">
                                @error('stock')
                                    <div style="font-size:12px;color:#dc2626;margin-top:4px;">
                                        <i class="bi bi-x-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label>Status Produk <span class="text-danger">*</span></label>
                                <select name="is_active"
                                        class="select {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                                    <option value="">— Pilih Status —</option>
                                    <option value="1"
                                        {{ old('is_active', $data->is_active) == '1' ? 'selected' : '' }}>
                                        ✅ Aktif — langsung tampil di katalog
                                    </option>
                                    <option value="0"
                                        {{ old('is_active', $data->is_active) == '0' ? 'selected' : '' }}>
                                        🚫 Tidak Aktif — disembunyikan dari katalog
                                    </option>
                                </select>
                                @error('is_active')
                                    <div style="font-size:12px;color:#dc2626;margin-top:4px;">
                                        <i class="bi bi-x-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Info box --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block">&nbsp;</label>
                                <div style="background:#f0fdf6;border:1px solid #bbf7d0;
                                            border-radius:6px;padding:9px 13px;font-size:12.5px;
                                            color:#14532d;display:flex;align-items:center;gap:8px;">
                                    <i class="bi bi-info-circle-fill flex-shrink-0"></i>
                                    <span>Perubahan status <strong>Aktif</strong> langsung
                                    mempengaruhi visibilitas produk di halaman customer.</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>{{-- /col-lg-8 --}}


        {{-- ════════════════════════════════════════════════
             KOLOM KANAN — Gambar + Aksi
        ════════════════════════════════════════════════ --}}
        <div class="col-lg-4">

            {{-- Card: Foto Produk --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-image me-2" style="color:#b17457;"></i>Foto Produk
                    </h5>
                </div>
                <div class="card-body">

                    {{-- Foto saat ini dari DB --}}
                    <div id="img-preview-wrap"
                         style="margin-bottom:14px;text-align:center;">
                        <img id="img-preview"
                             src="{{ asset('uploads/products/' . $data->image) }}"
                             alt="Foto produk"
                             style="max-width:100%;max-height:200px;
                                    border-radius:8px;object-fit:contain;
                                    border:1.5px solid #ede3db;">
                        <div id="img-preview-name"
                             style="font-size:11px;color:#7a6255;margin-top:5px;">
                            {{ $data->image }}
                        </div>
                    </div>

                    {{-- Upload zona (opsional — kosongkan jika tidak ganti) --}}
                    <div class="image-upload" id="upload-zone"
                         onclick="document.getElementById('inp-image').click()">
                        <input name="image"
                               id="inp-image"
                               type="file"
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               style="display:none;"
                               onchange="previewImage(this)">
                        <div id="upload-placeholder">
                            <img src="{{ asset('admin/img/icons/upload.svg') }}"
                                 alt="Upload" style="width:38px;opacity:.40;">
                            <h4 style="font-size:12.5px;color:#7a6255;margin-top:7px;">
                                Klik untuk ganti foto
                            </h4>
                            <p style="font-size:11px;color:#a89080;margin-top:2px;">
                                JPEG, PNG, WebP — Maks 2 MB<br>
                                <em>Kosongkan jika tidak ingin mengganti</em>
                            </p>
                        </div>
                    </div>

                    @error('image')
                        <div style="font-size:12px;color:#dc2626;margin-top:6px;">
                            <i class="bi bi-x-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Card: Aksi --}}
            <div class="card">
                <div class="card-body d-flex flex-column gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-lg"></i> Simpan Perubahan
                    </button>
                    <a href="{{ url('/product-list') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-x-lg"></i> Batal
                    </a>
                </div>
                <div class="card-body pt-0">
                    <div style="background:#fff8ee;border:1px solid #fde68a;
                                border-radius:6px;padding:10px 13px;font-size:12px;
                                color:#78350f;line-height:1.6;">
                        <strong>Setelah simpan:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            <li>Database diperbarui langsung (<code>UPDATE products</code>)</li>
                            <li>Daftar Produk admin menampilkan data terbaru</li>
                            <li>Halaman <code>/product</code> customer ikut berubah</li>
                            <li>Foto lama tetap jika tidak ada unggahan baru</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>{{-- /col-lg-4 --}}
    </div>{{-- /row --}}
</form>

{{-- ════════════════════════════════════════════════════════
     JAVASCRIPT — Live preview harga & gambar (sama dgn add.blade.php)
════════════════════════════════════════════════════════ --}}
<script>
/* ── Live harga akhir ────────────────────────────────────── */
(function () {
    const priceEl    = document.getElementById('inp-price');
    const discountEl = document.getElementById('inp-discount');
    const previewBox = document.getElementById('price-preview');
    const previewVal = document.getElementById('price-preview-val');

    function updatePreview() {
        const price    = parseFloat(priceEl?.value)    || 0;
        const discount = parseFloat(discountEl?.value) || 0;
        if (price <= 0) { previewBox.style.display = 'none'; return; }
        const final = price - (price * discount / 100);
        previewVal.textContent = 'Rp ' + final.toLocaleString('id-ID');
        previewBox.style.display = 'block';
    }

    priceEl?.addEventListener('input',    updatePreview);
    discountEl?.addEventListener('input', updatePreview);
    updatePreview(); // jalankan langsung saat halaman dimuat
})();

/* ── Preview gambar baru sebelum upload ──────────────────── */
function previewImage(input) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];

    if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran gambar melebihi 2 MB. Pilih file yang lebih kecil.');
        input.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById('img-preview').src          = e.target.result;
        document.getElementById('img-preview-name').textContent =
            file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB) — akan mengganti foto lama';
    };
    reader.readAsDataURL(file);
}

/* ── Drag & drop ke upload zone ─────────────────────────── */
(function () {
    const zone  = document.getElementById('upload-zone');
    const input = document.getElementById('inp-image');
    if (!zone || !input) return;

    zone.addEventListener('dragover', e => {
        e.preventDefault();
        zone.style.borderColor = '#b17457';
        zone.style.background  = '#fdf5ef';
    });
    zone.addEventListener('dragleave', () => {
        zone.style.borderColor = '';
        zone.style.background  = '';
    });
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.style.borderColor = '';
        zone.style.background  = '';
        if (e.dataTransfer.files.length) {
            input.files = e.dataTransfer.files;
            previewImage(input);
        }
    });
})();
</script>

@endsection
