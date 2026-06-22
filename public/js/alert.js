/**
 * Hema Indonesia — Global SweetAlert Handler v2
 *
 * Menangani SEMUA interaksi SweetAlert di panel admin:
 *   1. Flash messages  → success / error / validation errors dari Laravel session
 *   2. Konfirmasi HAPUS → tombol dengan class  .btn-delete
 *   3. Konfirmasi STATUS → tombol dengan class .confirm-status (toggle aktif/nonaktif)
 *
 * Cara pakai tombol hapus di blade:
 *   <button type="button"
 *           class="btn btn-sm btn-soft-danger btn-delete"
 *           data-form="form-delete-xxx"
 *           data-name="Nama Item">
 *       <i class="bi bi-trash"></i>
 *   </button>
 *   <form id="form-delete-xxx" action="{{ route('...') }}" method="POST" class="d-none">
 *       @csrf @method('DELETE')
 *   </form>
 */

/* ── Konfigurasi warna brand ─────────────────────────────── */
const BRAND = {
    primary:   '#b17457',
    secondary: '#c29470',
    danger:    '#dc2626',
    gradient:  'linear-gradient(135deg,#b17457 0%,#c29470 100%)',
};

/* ── Helper: tombol konfirmasi & batal dengan warna brand ── */
function swalBrandedConfirm(options) {
    return Swal.fire({
        title:              options.title              ?? 'Yakin?',
        html:               options.html               ?? '',
        icon:               options.icon               ?? 'question',
        showCancelButton:   true,
        confirmButtonText:  options.confirmButtonText  ?? 'Ya, Lanjutkan',
        cancelButtonText:   options.cancelButtonText   ?? 'Batal',
        reverseButtons:     true,
        customClass: {
            confirmButton: 'swal-btn-confirm',
            cancelButton:  'swal-btn-cancel',
            popup:         'swal-popup-brand',
        },
        buttonsStyling: false,   // pakai customClass di atas
    });
}

/* ── CSS inject sekali untuk SweetAlert buttons ─────────── */
(function injectSwalStyles() {
    if (document.getElementById('swal-brand-style')) return;
    const style = document.createElement('style');
    style.id    = 'swal-brand-style';
    style.textContent = `
        .swal-popup-brand { font-family: "Urbanist", sans-serif !important; border-radius: 16px !important; }
        .swal-popup-brand .swal2-title { font-family: "Urbanist", sans-serif !important; font-weight: 800; color: #1e1410; font-size: 1.2rem; }
        .swal-popup-brand .swal2-html-container { font-family: "Urbanist", sans-serif !important; color: #7a6255; font-size: 0.9rem; }
        .swal-popup-brand .swal2-icon { border-color: transparent !important; }

        /* Confirm button — merah untuk hapus, coklat untuk aksi lain */
        .swal-btn-confirm {
            background: ${BRAND.danger} !important;
            color: #fff !important;
            border: none !important;
            padding: 10px 26px !important;
            border-radius: 7px !important;
            font-weight: 700 !important;
            font-family: "Urbanist", sans-serif !important;
            font-size: 14px !important;
            cursor: pointer;
            transition: opacity .15s;
        }
        .swal-btn-confirm:hover { opacity: .86 !important; }

        /* Confirm button — varian brand (non-hapus) */
        .swal-btn-confirm.brand {
            background: ${BRAND.gradient} !important;
        }

        /* Cancel button */
        .swal-btn-cancel {
            background: #f0efed !important;
            color: #3d2e26 !important;
            border: 1.5px solid #d5cfc9 !important;
            padding: 10px 26px !important;
            border-radius: 7px !important;
            font-weight: 600 !important;
            font-family: "Urbanist", sans-serif !important;
            font-size: 14px !important;
            cursor: pointer;
            transition: background .15s;
        }
        .swal-btn-cancel:hover { background: #e4e0db !important; }
    `;
    document.head.appendChild(style);
})();


document.addEventListener('DOMContentLoaded', function () {

    /* ════════════════════════════════════════════════════
       1. FLASH MESSAGES — dari Laravel session via <meta>
    ════════════════════════════════════════════════════ */
    const successMsg   = document.querySelector('meta[name="success"]')?.content;
    const successTimer = document.querySelector('meta[name="success_timer"]')?.content;
    const errorMsg     = document.querySelector('meta[name="error"]')?.content;
    const errorsRaw    = document.querySelector('meta[name="errors"]')?.content || '[]';
    let   validErrors  = [];

    try { validErrors = JSON.parse(errorsRaw); } catch (_) {}

    if (successMsg) {
        Swal.fire({
            title:              successMsg,
            icon:               'success',
            confirmButtonColor: BRAND.primary,
            customClass: {
                popup:         'swal-popup-brand',
                confirmButton: 'swal-btn-confirm brand',
            },
            buttonsStyling: false,
        });
    }

    if (successTimer) {
        Swal.fire({
            title:              successTimer,
            icon:               'success',
            showConfirmButton:  false,
            timer:              1800,
            timerProgressBar:   true,
            customClass: { popup: 'swal-popup-brand' },
        });
    }

    if (errorMsg) {
        Swal.fire({
            title:           'Terjadi Kesalahan',
            html:            `<p>${errorMsg}</p>`,
            icon:            'error',
            customClass: {
                popup:         'swal-popup-brand',
                confirmButton: 'swal-btn-confirm brand',
            },
            buttonsStyling: false,
        });
    }

    if (validErrors.length > 0) {
        Swal.fire({
            title:  'Data Tidak Valid',
            html:   '<ul style="text-align:left;padding-left:18px;margin:0;">'
                  + validErrors.map(e => `<li style="margin-bottom:4px;">${e}</li>`).join('')
                  + '</ul>',
            icon:            'warning',
            confirmButtonText: 'OK, Periksa Kembali',
            customClass: {
                popup:         'swal-popup-brand',
                confirmButton: 'swal-btn-confirm brand',
            },
            buttonsStyling: false,
        });
    }


    /* ════════════════════════════════════════════════════
       2. KONFIRMASI HAPUS — tombol .btn-delete
          Atribut yang dibaca:
            data-form  : id dari <form> yang akan di-submit
            data-name  : nama item yang ditampilkan di dialog
            data-type  : jenis item (opsional, mis: "produk", "FAQ")
    ════════════════════════════════════════════════════ */
    document.querySelectorAll('.btn-delete').forEach(function (btn) {
        btn.addEventListener('click', async function (e) {
            e.preventDefault();

            const formId   = this.dataset.form ?? '';
            const itemName = this.dataset.name ?? 'item ini';
            const itemType = this.dataset.type ?? 'data';
            const form     = document.getElementById(formId);

            if (!form) {
                console.warn('[alert.js] Form tidak ditemukan:', formId);
                return;
            }

            const result = await swalBrandedConfirm({
                title: `Hapus ${itemType}?`,
                html:  `<p>Kamu akan menghapus <strong>"${itemName}"</strong>.</p>
                        <p style="color:#ef4444;font-size:0.82rem;margin-top:8px;">
                            ⚠️ Tindakan ini <strong>tidak dapat dibatalkan</strong>.
                        </p>`,
                icon:              'warning',
                confirmButtonText: `Ya, Hapus`,
                cancelButtonText:  'Batal',
            });

            if (result.isConfirmed) {
                /* Tampilkan loading sebentar sebelum submit */
                Swal.fire({
                    title:            'Menghapus...',
                    allowOutsideClick: false,
                    showConfirmButton:  false,
                    didOpen: () => Swal.showLoading(),
                    customClass: { popup: 'swal-popup-brand' },
                });
                form.submit();
            }
        });
    });


    /* ════════════════════════════════════════════════════
       3. KONFIRMASI STATUS TOGGLE — tombol .confirm-status
          (toggle aktif / nonaktif untuk produk, galeri, FAQ)
    ════════════════════════════════════════════════════ */
    document.querySelectorAll('.confirm-status').forEach(function (btn) {
        btn.addEventListener('click', async function (e) {
            e.preventDefault();

            const form      = this.closest('form');
            const checkbox  = form?.querySelector('input[type="checkbox"]');
            const isChecked = checkbox?.checked ?? false;
            const action    = isChecked ? 'Nonaktifkan' : 'Aktifkan';
            const icon      = isChecked ? 'question'   : 'question';

            const result = await swalBrandedConfirm({
                title:             `${action} item ini?`,
                html:              `<p>Status akan diubah menjadi <strong>${isChecked ? 'Tidak Aktif' : 'Aktif'}</strong>.</p>`,
                icon:              icon,
                confirmButtonText: `Ya, ${action}`,
                cancelButtonText:  'Batal',
            });

            if (result.isConfirmed && form) {
                form.submit();
            }
        });
    });


    /* ════════════════════════════════════════════════════
       4. LEGACY — confirm-text (class lama, fallback)
          Mendukung tombol <button class="confirm-text" type="submit">
          yang masih ada di beberapa blade lama.
          Jika sudah pakai .btn-delete, ini tidak dipicu.
    ════════════════════════════════════════════════════ */
    document.querySelectorAll('.confirm-text:not(.btn-delete)').forEach(function (btn) {
        /* Hanya pasang jika bukan sudah punya listener .btn-delete */
        if (btn.classList.contains('btn-delete')) return;

        btn.addEventListener('click', async function (e) {
            e.preventDefault();

            const form = this.closest('form');
            if (!form) return;

            const result = await swalBrandedConfirm({
                title:             'Hapus data ini?',
                html:              '<p style="color:#ef4444;font-size:0.82rem;">Tindakan ini tidak dapat dibatalkan.</p>',
                icon:              'warning',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText:  'Batal',
            });

            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

});
