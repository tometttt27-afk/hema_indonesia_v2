@extends('template.layout-admin')
@section('title_web', 'Tambah Produk | Hema.Indonesia')
@section('content-admin')

<div class="page-header">
    <div class="page-title">
        <nav class="breadcrumb-admin">
            <a href="{{ url('/product-list') }}">Data Produk</a>
            <span class="sep">/</span>
            <span class="current">Tambah Produk</span>
        </nav>
        <h4>Tambah Produk Baru</h4>
        <h6>Data akan langsung muncul di katalog customer jika status <strong>Aktif</strong></h6>
    </div>
    <a href="{{ url('/product-list') }}" class="btn btn-secondary btn-cancel-nav"
       data-form="form-add-product">
        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
        Kembali
    </a>
</div>

@if($errors->any())
<div class="alert alert-danger d-flex align-items-start gap-3 mb-4">
    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" class="flex-shrink-0 mt-1" style="color:var(--red);">
        <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
    </svg>
    <div>
        <strong>Terdapat {{ $errors->count() }} kesalahan:</strong>
        <ul class="mb-0 mt-1 ps-3">
            @foreach($errors->all() as $error)<li style="font-size:13px;">{{ $error }}</li>@endforeach
        </ul>
    </div>
</div>
@endif

<form action="{{ route('productsListPost') }}" method="POST" enctype="multipart/form-data"
      id="form-add-product" novalidate>
    @csrf
    <div class="row g-3">
        <div class="col-lg-8">

            <div class="card mb-3">
                <div class="card-header">
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/>
                        <circle cx="7" cy="7" r="1.5" fill="white"/>
                    </svg>
                    <h5 class="card-title mb-0">Identitas Produk</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="inp-name" value="{{ old('name') }}"
                                       autocomplete="off" placeholder="Contoh: Gamis Elegan Motif Batik"
                                       class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                                @error('name')<span class="field-error"><svg width="11" height="11" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg> {{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Kode Produk</label>
                                <input type="text" name="code_product" id="inp-code" value="{{ old('code_product') }}"
                                       autocomplete="off" placeholder="Auto-generate" readonly>
                                <small style="font-size:11px;color:var(--tx-4);margin-top:3px;display:block;">Otomatis dari nama produk</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select name="category_id" class="js-example-basic-single select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                                    <option value="">— Pilih Kategori —</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Ukuran Tersedia <span class="text-danger">*</span></label>
                                <select name="size[]" class="form-control basic tagging {{ $errors->has('size') ? 'is-invalid' : '' }}" multiple="multiple">
                                    @php $oldSizes=old('size',[]); @endphp
                                    @foreach(['xs','s','m','l','xl','xxl','xxxl','custom'] as $sz)
                                        <option value="{{ $sz }}" {{ in_array($sz,$oldSizes)?'selected':'' }}>{{ strtoupper($sz) }}</option>
                                    @endforeach
                                </select>
                                @error('size')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label>Deskripsi Produk <span class="text-danger">*</span></label>
                                <textarea name="description" rows="5"
                                          placeholder="Jelaskan detail produk: bahan, keunggulan, petunjuk perawatan..."
                                          class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') }}</textarea>
                                @error('description')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                        <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                    </svg>
                    <h5 class="card-title mb-0">Harga &amp; Stok</h5>
                    <div id="price-preview" style="font-size:13px;font-weight:700;color:var(--br);padding:5px 12px;background:var(--br-soft);border-radius:6px;display:none;">
                        Harga akhir: <span id="price-preview-val">—</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Harga (Rp) <span class="text-danger">*</span></label>
                                <input type="number" name="price" id="inp-price" value="{{ old('price') }}"
                                       min="0" step="100" placeholder="Contoh: 150000" autocomplete="off"
                                       class="{{ $errors->has('price') ? 'is-invalid' : '' }}">
                                @error('price')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Diskon (%)</label>
                                <input type="number" name="discount" id="inp-discount" value="{{ old('discount',0) }}"
                                       min="0" max="100" step="1" placeholder="0 (tanpa diskon)" autocomplete="off"
                                       class="{{ $errors->has('discount') ? 'is-invalid' : '' }}">
                                @error('discount')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stock" id="inp-stock" value="{{ old('stock') }}"
                                       min="0" step="1" placeholder="Contoh: 50" autocomplete="off"
                                       class="{{ $errors->has('stock') ? 'is-invalid' : '' }}">
                                @error('stock')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label>Status Produk <span class="text-danger">*</span></label>
                                <select name="is_active" class="select {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                                    <option value="">— Pilih Status —</option>
                                    <option value="1" {{ old('is_active')==='1'?'selected':'' }}>✅ Aktif — tampil di katalog</option>
                                    <option value="0" {{ old('is_active')==='0'?'selected':'' }}>🚫 Tidak Aktif — tersembunyi</option>
                                </select>
                                @error('is_active')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-0">
                                <label class="d-block">&nbsp;</label>
                                <div style="background:var(--green-lt);border:1px solid #bbf7d0;border-radius:6px;padding:9px 13px;font-size:12.5px;color:#14532d;display:flex;align-items:center;gap:8px;">
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                                    <span>Status <strong>Aktif</strong> → langsung muncul di halaman <code>/product</code> customer.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header">
                    <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="color:var(--br);">
                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                    </svg>
                    <h5 class="card-title mb-0">Foto Produk <span class="text-danger">*</span></h5>
                </div>
                <div class="card-body">
                    <div id="img-preview-wrap" style="display:none;margin-bottom:14px;text-align:center;">
                        <img id="img-preview" src="" alt="Preview"
                             style="max-width:100%;max-height:200px;border-radius:8px;object-fit:contain;border:1px solid var(--bd);">
                        <div id="img-preview-name" style="font-size:11.5px;color:var(--tx-3);margin-top:6px;"></div>
                    </div>
                    <div class="image-upload" id="upload-zone" onclick="document.getElementById('inp-image').click()">
                        <input name="image" id="inp-image" type="file"
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               style="display:none;" onchange="previewImage(this)">
                        <div id="upload-placeholder">
                            <svg width="40" height="40" fill="currentColor" viewBox="0 0 24 24"
                                 style="color:var(--br-lt);opacity:.6;margin:0 auto 8px;">
                                <path d="M19.35 10.04A7.49 7.49 0 0012 4C9.11 4 6.6 5.64 5.35 8.04A5.994 5.994 0 000 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                            </svg>
                            <h4 style="font-size:13px;color:var(--tx-3);margin-top:0;">Klik atau drag &amp; drop</h4>
                            <p style="font-size:11.5px;color:var(--tx-4);margin-top:2px;">JPEG, PNG, WebP — Maks 2 MB</p>
                        </div>
                    </div>
                    @error('image')<span class="field-error mt-2 d-block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="card">
                <div class="card-body d-flex flex-column gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>
                        Simpan &amp; Publikasikan
                    </button>
                    <button type="reset" class="btn btn-cancel w-100" onclick="clearImagePreview()">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/></svg>
                        Reset Form
                    </button>
                    <a href="{{ url('/product-list') }}" class="btn btn-secondary w-100 btn-cancel-nav"
                       data-form="form-add-product">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
(function(){
    const nameEl=document.getElementById('inp-name'),codeEl=document.getElementById('inp-code');
    if(nameEl&&codeEl) nameEl.addEventListener('input',function(){
        const slug=this.value.toLowerCase().trim().replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-').substring(0,30);
        const uid=Math.random().toString(36).substr(2,5);
        codeEl.value=slug?`${slug}-${uid}`:'';
    });
    const priceEl=document.getElementById('inp-price'),discEl=document.getElementById('inp-discount'),
          prevBox=document.getElementById('price-preview'),prevVal=document.getElementById('price-preview-val');
    function upd(){const p=parseFloat(priceEl?.value)||0,d=parseFloat(discEl?.value)||0;if(p<=0){prevBox.style.display='none';return;}prevVal.textContent='Rp '+(p-p*d/100).toLocaleString('id-ID');prevBox.style.display='block';}
    priceEl?.addEventListener('input',upd);discEl?.addEventListener('input',upd);upd();
    const zone=document.getElementById('upload-zone'),inp=document.getElementById('inp-image');
    if(zone&&inp){
        zone.addEventListener('dragover',e=>{e.preventDefault();zone.style.borderColor='var(--br)';zone.style.background='var(--br-soft)';});
        zone.addEventListener('dragleave',()=>{zone.style.borderColor='';zone.style.background='';});
        zone.addEventListener('drop',e=>{e.preventDefault();zone.style.borderColor='';zone.style.background='';if(e.dataTransfer.files.length){inp.files=e.dataTransfer.files;previewImage(inp);}});
    }
})();
function previewImage(input){
    if(!input.files||!input.files[0])return;
    const file=input.files[0];
    if(file.size>2*1024*1024){alert('Ukuran gambar melebihi 2 MB.');input.value='';return;}
    const r=new FileReader();
    r.onload=e=>{document.getElementById('img-preview').src=e.target.result;document.getElementById('img-preview-name').textContent=file.name+' ('+(file.size/1024).toFixed(1)+' KB)';document.getElementById('img-preview-wrap').style.display='block';document.getElementById('upload-placeholder').style.display='none';};
    r.readAsDataURL(file);
}
function clearImagePreview(){document.getElementById('img-preview').src='';document.getElementById('img-preview-wrap').style.display='none';document.getElementById('upload-placeholder').style.display='block';}
</script>
@endsection
