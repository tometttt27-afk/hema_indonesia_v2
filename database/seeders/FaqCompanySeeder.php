<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqCompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('faq_company')->insert([
            [
                'title'       => 'Bagaimana cara melakukan pemesanan di Hema Indonesia?',
                'description' => 'Anda dapat melakukan pemesanan dengan mudah melalui website kami. Pilih produk yang Anda inginkan, tambahkan ke keranjang belanja, isi data pengiriman, lalu lakukan pembayaran melalui metode yang tersedia seperti transfer bank, QRIS, GoPay, OVO, atau kartu kredit.',
                'code_faq'    => 'FAQ-001',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Berapa lama estimasi pengiriman pesanan saya?',
                'description' => 'Estimasi pengiriman tergantung pada lokasi tujuan dan kurir yang dipilih. Untuk wilayah Jabodetabek, estimasi pengiriman adalah 1-2 hari kerja. Untuk Pulau Jawa, 2-3 hari kerja. Untuk luar Pulau Jawa, 3-7 hari kerja. Semua estimasi dihitung setelah pesanan diproses.',
                'code_faq'    => 'FAQ-002',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Apakah saya bisa melakukan pengembalian atau penukaran barang?',
                'description' => 'Ya, Hema Indonesia menerima pengembalian dan penukaran barang dalam kondisi produk masih belum dipakai, tag masih terpasang, dan dalam waktu 7 hari setelah barang diterima. Hubungi tim customer service kami melalui WhatsApp atau email untuk memulai proses retur.',
                'code_faq'    => 'FAQ-003',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Metode pembayaran apa saja yang tersedia?',
                'description' => 'Hema Indonesia menerima berbagai metode pembayaran melalui Midtrans, antara lain: Transfer Bank (BCA, BNI, BRI, Mandiri), Kartu Kredit/Debit (Visa, Mastercard), QRIS, GoPay, OVO, Dana, ShopeePay, dan Indomaret/Alfamart.',
                'code_faq'    => 'FAQ-004',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Apakah produk Hema Indonesia original dan berkualitas?',
                'description' => 'Seluruh produk Hema Indonesia adalah produk original yang diproduksi sendiri oleh tim kami. Kami menggunakan bahan-bahan berkualitas pilihan dan telah melalui quality control yang ketat sebelum sampai ke tangan pelanggan. Kepuasan pelanggan adalah prioritas utama kami.',
                'code_faq'    => 'FAQ-005',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Bagaimana cara memilih ukuran yang tepat?',
                'description' => 'Setiap produk di website kami dilengkapi dengan size chart yang menjelaskan dimensi detail tiap ukuran. Kami menyarankan Anda mengukur lingkar dada, pinggang, dan panjang badan terlebih dahulu, kemudian menyesuaikan dengan size chart yang tersedia di halaman produk.',
                'code_faq'    => 'FAQ-006',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Apakah ada program loyalitas atau diskon khusus pelanggan setia?',
                'description' => 'Ya! Hema Indonesia memiliki program member eksklusif untuk pelanggan setia. Dengan bergabung, Anda akan mendapatkan poin reward setiap pembelian, akses early sale, diskon ulang tahun, dan berbagai penawaran eksklusif lainnya yang tidak tersedia untuk umum.',
                'code_faq'    => 'FAQ-007',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'title'       => 'Bagaimana cara menghubungi customer service Hema Indonesia?',
                'description' => 'Anda dapat menghubungi tim customer service kami melalui: WhatsApp di nomor 0812-0000-0001 (Senin–Sabtu, 08.00–17.00 WIB), email ke cs@hema.id, atau melalui DM Instagram @hema.indonesia. Kami siap membantu menjawab semua pertanyaan Anda.',
                'code_faq'    => 'FAQ-008',
                'is_active'   => false,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
