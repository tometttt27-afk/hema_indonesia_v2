/**
 * Hema Indonesia — Global SweetAlert Handler v3
 *
 * PERBAIKAN UTAMA:
 *   Event delegation via document.addEventListener('click') menggantikan
 *   querySelectorAll + forEach, sehingga tombol yang di-render ulang oleh
 *   DataTables (setelah DOMContentLoaded) tetap terikat handler.
 *
 * Handler yang dikelola:
 *   .btn-delete      → konfirmasi hapus (DELETE)
 *   .confirm-status  → konfirmasi toggle aktif/nonaktif
 *   .confirm-text    → legacy fallback (tipe submit biasa)
 */

/* ─── Warna brand ─────────────────────────────────────────── */
const BRAND = {
    primary  : '#b17457',
    gradient : 'linear-gradient(135deg,#b17457 0%,#c29470 100%)',
    danger   : '#dc2626',
};

/* ─── Inject CSS SweetAlert sekali ──────────────────────────
   Dipanggil saat pertama kali tombol diklik, bukan saat load.
   Aman untuk DataTables karena tidak bergantung DOM timing. */
let _swalStyleInjected = false;
function injectSwalStyles() {
    if (_swalStyleInjected) return;
    _swalStyleInjected = true;

    const style = document.createElement('style');
    style.textContent = `
        /* ── Popup ── */
        .swal-hema { font-family:"Urbanist",sans-serif !important; border-radius:16px !important; }
        .swal-hema .swal2-title   { font-family:"Urbanist",sans-serif !important; font-weight:800; color:#1e1410; font-size:1.15rem; }
        .swal-hema .swal2-html-container { font-family:"Urbanist",sans-serif !important; color:#7a6255; font-size:.875rem; }
        .swal-hema .swal2-icon    { border-color:transparent !important; }

        /* ── Confirm merah (hapus) ── */
        .swal-btn-danger {
            background:${BRAND.danger} !important; color:#fff !important;
            border:none !important; padding:10px 28px !important;
            border-radius:7px !important; font-weight:700 !important;
            font-family:"Urbanist",sans-serif !important; font-size:14px !important;
            cursor:pointer; transition:opacity .15s;
        }
        .swal-btn-danger:hover { opacity:.85 !important; }

        /* ── Confirm brand (status toggle / generic) ── */
        .swal-btn-brand {
            background:${BRAND.gradient} !important; color:#fff !important;
            border:none !important; padding:10px 28px !important;
            border-radius:7px !important; font-weight:700 !important;
            font-family:"Urbanist",sans-serif !important; font-size:14px !important;
            cursor:pointer; transition:opacity .15s;
        }
        .swal-btn-brand:hover { opacity:.85 !important; }

        /* ── Cancel ── */
        .swal-btn-cancel {
            background:#f0efed !important; color:#3d2e26 !important;
            border:1.5px solid #d5cfc9 !important; padding:10px 28px !important;
            border-radius:7px !important; font-weight:600 !important;
            font-family:"Urbanist",sans-serif !important; font-size:14px !important;
            cursor:pointer; transition:background .15s;
        }
        .swal-btn-cancel:hover { background:#e4e0db !important; }
    `;
    document.head.appendChild(style);
}

/* ─── Helper: popup konfirmasi seragam ──────────────────── */
function swalConfirm({ title, html, confirmText, confirmClass }) {
    injectSwalStyles();
    return Swal.fire({
        title,
        html,
        icon             : 'warning',
        showCancelButton : true,
        confirmButtonText: confirmText ?? 'Ya, Lanjutkan',
        cancelButtonText : 'Batal',
        reverseButtons   : true,
        buttonsStyling   : false,
        customClass      : {
            popup         : 'swal-hema',
            confirmButton : confirmClass ?? 'swal-btn-brand',
            cancelButton  : 'swal-btn-cancel',
        },
    });
}

/* ════════════════════════════════════════════════════════════
   EVENT DELEGATION — satu listener di document menangkap
   SEMUA klik, termasuk elemen yang baru di-render DataTables.
   Tidak ada querySelectorAll, tidak ada forEach, tidak perlu
   DOMContentLoaded untuk tombol-tombol ini.
════════════════════════════════════════════════════════════ */
document.addEventListener('click', async function (e) {

    /* ── 1. Konfirmasi HAPUS (.btn-delete) ────────────────────
       HTML yang dibutuhkan di blade:
         <button type="button"
                 class="btn btn-sm btn-soft-danger btn-delete"
                 data-form="form-del-prod-xxx"
                 data-name="Nama Produk"
                 data-type="Produk">
             <i class="bi bi-trash"></i>
         </button>
         <form id="form-del-prod-xxx" class="d-none" method="POST"
               action="{{ route('...') }}">
             @csrf @method('DELETE')
         </form>
    ──────────────────────────────────────────────────────── */
    const deleteBtn = e.target.closest('.btn-delete');
    if (deleteBtn) {
        e.preventDefault();
        e.stopPropagation();

        const formId   = deleteBtn.dataset.form ?? '';
        const itemName = deleteBtn.dataset.name ?? 'item ini';
        const itemType = deleteBtn.dataset.type ?? 'Data';
        const form     = document.getElementById(formId);

        if (!form) {
            console.error('[alert.js] Form tidak ditemukan, id:', formId);
            return;
        }

        const result = await swalConfirm({
            title        : `Hapus ${itemType}?`,
            html         : `<p>Kamu akan menghapus <strong>"${itemName}"</strong>.</p>
                            <p style="margin-top:8px;color:#ef4444;font-size:.8rem;">
                                ⚠️ Tindakan ini <strong>tidak dapat dibatalkan</strong>.
                            </p>`,
            confirmText  : 'Ya, Hapus!',
            confirmClass : 'swal-btn-danger',
        });

        if (result.isConfirmed) {
            injectSwalStyles();
            Swal.fire({
                title            : 'Menghapus...',
                allowOutsideClick: false,
                showConfirmButton : false,
                customClass      : { popup: 'swal-hema' },
                didOpen          : () => Swal.showLoading(),
            });
            form.submit();
        }
        return; // jangan lanjut ke handler lain
    }

    /* ── 2. Konfirmasi STATUS TOGGLE (.confirm-status) ────────
       Tombol di dalam <form> dengan checkbox di dalamnya.
    ──────────────────────────────────────────────────────── */
    const statusBtn = e.target.closest('.confirm-status');
    if (statusBtn) {
        e.preventDefault();
        e.stopPropagation();

        const form      = statusBtn.closest('form');
        const checkbox  = form?.querySelector('input[type="checkbox"]');
        const isActive  = checkbox?.checked ?? false;
        const action    = isActive ? 'Nonaktifkan' : 'Aktifkan';
        const newStatus = isActive ? 'Tidak Aktif' : 'Aktif';

        const result = await swalConfirm({
            title        : `${action} item ini?`,
            html         : `<p>Status akan diubah menjadi <strong>${newStatus}</strong>.</p>`,
            confirmText  : `Ya, ${action}`,
            confirmClass : 'swal-btn-brand',
        });

        if (result.isConfirmed && form) {
            form.submit();
        }
        return;
    }

    /* ── 3. Legacy fallback (.confirm-text, type=submit) ──────
       Mendukung tombol lama yang masih ada di beberapa blade.
       Cara kerja: tombol ini type=submit, kita cancel submit-nya,
       tampilkan dialog, baru submit form secara manual.
    ──────────────────────────────────────────────────────── */
    const legacyBtn = e.target.closest('.confirm-text');
    if (legacyBtn && !legacyBtn.classList.contains('btn-delete')) {
        e.preventDefault();
        e.stopPropagation();

        const form = legacyBtn.closest('form');
        if (!form) return;

        const result = await swalConfirm({
            title        : 'Hapus data ini?',
            html         : '<p style="color:#ef4444;font-size:.82rem;">Tindakan ini tidak dapat dibatalkan.</p>',
            confirmText  : 'Ya, Hapus!',
            confirmClass : 'swal-btn-danger',
        });

        if (result.isConfirmed) {
            form.submit();
        }
    }
});

/* ════════════════════════════════════════════════════════════
   FLASH MESSAGES — dari Laravel session via <meta> di layout
   Ini tetap di DOMContentLoaded karena meta sudah ada di DOM
   sebelum DataTables berjalan.
════════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function () {

    const successMsg   = document.querySelector('meta[name="success"]')?.content?.trim();
    const successTimer = document.querySelector('meta[name="success_timer"]')?.content?.trim();
    const errorMsg     = document.querySelector('meta[name="error"]')?.content?.trim();
    const errorsRaw    = document.querySelector('meta[name="errors"]')?.content || '[]';
    let   validErrors  = [];

    try { validErrors = JSON.parse(errorsRaw); } catch (_) {}

    /* Hanya tampilkan jika ada konten */
    if (successMsg) {
        injectSwalStyles();
        Swal.fire({
            title        : successMsg,
            icon         : 'success',
            buttonsStyling: false,
            customClass  : { popup: 'swal-hema', confirmButton: 'swal-btn-brand' },
        });
    }

    if (successTimer) {
        injectSwalStyles();
        Swal.fire({
            title            : successTimer,
            icon             : 'success',
            showConfirmButton : false,
            timer            : 1800,
            timerProgressBar : true,
            customClass      : { popup: 'swal-hema' },
        });
    }

    if (errorMsg) {
        injectSwalStyles();
        Swal.fire({
            title        : 'Terjadi Kesalahan',
            html         : `<p>${errorMsg}</p>`,
            icon         : 'error',
            buttonsStyling: false,
            customClass  : { popup: 'swal-hema', confirmButton: 'swal-btn-brand' },
        });
    }

    if (validErrors.length > 0) {
        injectSwalStyles();
        Swal.fire({
            title            : 'Data Tidak Valid',
            html             : '<ul style="text-align:left;padding-left:18px;margin:0;line-height:1.9;">'
                             + validErrors.map(e => `<li>${e}</li>`).join('')
                             + '</ul>',
            icon             : 'warning',
            confirmButtonText: 'Oke, Periksa Kembali',
            buttonsStyling   : false,
            customClass      : { popup: 'swal-hema', confirmButton: 'swal-btn-brand' },
        });
    }
});
