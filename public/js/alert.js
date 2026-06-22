/**
 * Hema Indonesia — SweetAlert Handler
 * Dipasang di akhir layout-admin.blade.php, setelah sweetalert2.min.js
 * sehingga Swal sudah pasti terdefinisi saat file ini dijalankan.
 */

/* ── CSS SweetAlert (inject sekali) ─────────────────────── */
(function () {
    var style = document.createElement('style');
    style.textContent = [
        '.swal-hema{font-family:"Urbanist",sans-serif!important;border-radius:16px!important}',
        '.swal-hema .swal2-title{font-family:"Urbanist",sans-serif!important;font-weight:800;color:#1e1410;font-size:1.15rem}',
        '.swal-hema .swal2-html-container{font-family:"Urbanist",sans-serif!important;color:#7a6255;font-size:.875rem}',
        '.swal-btn-danger{background:#dc2626!important;color:#fff!important;border:none!important;padding:10px 28px!important;border-radius:7px!important;font-weight:700!important;font-family:"Urbanist",sans-serif!important;font-size:14px!important;cursor:pointer}',
        '.swal-btn-brand{background:linear-gradient(135deg,#b17457,#c29470)!important;color:#fff!important;border:none!important;padding:10px 28px!important;border-radius:7px!important;font-weight:700!important;font-family:"Urbanist",sans-serif!important;font-size:14px!important;cursor:pointer}',
        '.swal-btn-cancel{background:#f0efed!important;color:#3d2e26!important;border:1.5px solid #d5cfc9!important;padding:10px 28px!important;border-radius:7px!important;font-weight:600!important;font-family:"Urbanist",sans-serif!important;font-size:14px!important;cursor:pointer}',
    ].join('');
    document.head.appendChild(style);
}());

/* ── Helper konfirmasi ───────────────────────────────────── */
function hemaSwalConfirm(opts) {
    return Swal.fire({
        title            : opts.title,
        html             : opts.html || '',
        icon             : 'warning',
        showCancelButton : true,
        confirmButtonText: opts.confirmText || 'Ya',
        cancelButtonText : 'Batal',
        reverseButtons   : true,
        buttonsStyling   : false,
        customClass      : {
            popup         : 'swal-hema',
            confirmButton : opts.confirmClass || 'swal-btn-brand',
            cancelButton  : 'swal-btn-cancel',
        },
    });
}

/* ════════════════════════════════════════════════════════════
   EVENT DELEGATION — satu listener di document
   Menangkap klik dari SEMUA elemen termasuk hasil render
   DataTables yang muncul setelah halaman pertama kali load.
════════════════════════════════════════════════════════════ */
document.addEventListener('click', function (e) {

    /* ── 1. Tombol Hapus (.btn-delete) ────────────────────── */
    var deleteBtn = e.target.closest('.btn-delete');
    if (deleteBtn) {
        e.preventDefault();
        e.stopPropagation();

        var formId   = deleteBtn.getAttribute('data-form') || '';
        var itemName = deleteBtn.getAttribute('data-name') || 'item ini';
        var itemType = deleteBtn.getAttribute('data-type') || 'Data';
        var form     = document.getElementById(formId);

        if (!form) {
            console.error('[alert.js] Form tidak ditemukan:', formId);
            return;
        }

        hemaSwalConfirm({
            title       : 'Hapus ' + itemType + '?',
            html        : '<p>Kamu akan menghapus <strong>"' + itemName + '"</strong>.</p>'
                        + '<p style="margin-top:8px;color:#ef4444;font-size:.82rem;">'
                        + '&#9888; Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>',
            confirmText : 'Ya, Hapus!',
            confirmClass: 'swal-btn-danger',
        }).then(function (result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });

        return;
    }

    /* ── 2. Toggle Status (.confirm-status) ──────────────── */
    var statusBtn = e.target.closest('.confirm-status');
    if (statusBtn) {
        e.preventDefault();
        e.stopPropagation();

        var form2     = statusBtn.closest('form');
        var checkbox  = form2 ? form2.querySelector('input[type="checkbox"]') : null;
        var isActive  = checkbox ? checkbox.checked : false;
        var action    = isActive ? 'Nonaktifkan' : 'Aktifkan';
        var newStatus = isActive ? 'Tidak Aktif' : 'Aktif';

        hemaSwalConfirm({
            title       : action + ' item ini?',
            html        : '<p>Status akan diubah menjadi <strong>' + newStatus + '</strong>.</p>',
            confirmText : 'Ya, ' + action,
            confirmClass: 'swal-btn-brand',
        }).then(function (result) {
            if (result.isConfirmed && form2) {
                form2.submit();
            }
        });

        return;
    }

    /* ── 3. Legacy (.confirm-text) ───────────────────────── */
    var legacyBtn = e.target.closest('.confirm-text');
    if (legacyBtn) {
        e.preventDefault();
        e.stopPropagation();

        var form3 = legacyBtn.closest('form');
        if (!form3) return;

        hemaSwalConfirm({
            title       : 'Hapus data ini?',
            html        : '<p style="color:#ef4444;font-size:.82rem;">Tindakan ini tidak dapat dibatalkan.</p>',
            confirmText : 'Ya, Hapus!',
            confirmClass: 'swal-btn-danger',
        }).then(function (result) {
            if (result.isConfirmed) {
                form3.submit();
            }
        });
    }
});

/* ════════════════════════════════════════════════════════════
   FLASH MESSAGES — dari Laravel session via <meta>
════════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function () {

    var successMsg   = (document.querySelector('meta[name="success"]')   || {}).content || '';
    var successTimer = (document.querySelector('meta[name="success_timer"]') || {}).content || '';
    var errorMsg     = (document.querySelector('meta[name="error"]')     || {}).content || '';
    var errorsRaw    = (document.querySelector('meta[name="errors"]')    || {}).content || '[]';
    var validErrors  = [];

    try { validErrors = JSON.parse(errorsRaw); } catch (e) {}

    if (successMsg.trim()) {
        Swal.fire({
            title          : successMsg,
            icon           : 'success',
            buttonsStyling : false,
            customClass    : { popup: 'swal-hema', confirmButton: 'swal-btn-brand' },
        });
    }

    if (successTimer.trim()) {
        Swal.fire({
            title            : successTimer,
            icon             : 'success',
            showConfirmButton: false,
            timer            : 1800,
            timerProgressBar : true,
            customClass      : { popup: 'swal-hema' },
        });
    }

    if (errorMsg.trim()) {
        Swal.fire({
            title          : 'Terjadi Kesalahan',
            html           : '<p>' + errorMsg + '</p>',
            icon           : 'error',
            buttonsStyling : false,
            customClass    : { popup: 'swal-hema', confirmButton: 'swal-btn-brand' },
        });
    }

    if (validErrors.length > 0) {
        var listHtml = '<ul style="text-align:left;padding-left:18px;margin:0;line-height:1.9;">'
            + validErrors.map(function (e) { return '<li>' + e + '</li>'; }).join('')
            + '</ul>';
        Swal.fire({
            title            : 'Data Tidak Valid',
            html             : listHtml,
            icon             : 'warning',
            confirmButtonText: 'Oke, Periksa Kembali',
            buttonsStyling   : false,
            customClass      : { popup: 'swal-hema', confirmButton: 'swal-btn-brand' },
        });
    }
});
