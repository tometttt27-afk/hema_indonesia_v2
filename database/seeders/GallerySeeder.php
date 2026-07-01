<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gallery')->insert([
            [
                'title'        => 'Koleksi Summer 2026',
                'image'        => 'gallery/summer-2026.jpg',
                'code_gallery' => 'GLR-001',
                'description'  => 'Foto koleksi pakaian summer 2026, menampilkan warna-warna cerah dan motif tropis yang menyegarkan.',
                'is_active'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'title'        => 'Pemotretan Hijab Koleksi Terbaru',
                'image'        => 'gallery/hijab-collection.jpg',
                'code_gallery' => 'GLR-002',
                'description'  => 'Sesi pemotretan eksklusif koleksi hijab terbaru bersama model profesional di studio kami.',
                'is_active'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'title'        => 'Behind The Scene Produksi',
                'image'        => 'gallery/bts-produksi.jpg',
                'code_gallery' => 'GLR-003',
                'description'  => 'Dokumentasi di balik layar proses produksi pakaian Hema Indonesia, dari bahan baku hingga produk jadi.',
                'is_active'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'title'        => 'Fashion Show Ramadan 2026',
                'image'        => 'gallery/fashion-show-ramadan.jpg',
                'code_gallery' => 'GLR-004',
                'description'  => 'Galeri foto fashion show koleksi Ramadan 2026 yang digelar di Jakarta Convention Center.',
                'is_active'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'title'        => 'Koleksi Batik Nusantara',
                'image'        => 'gallery/batik-nusantara.jpg',
                'code_gallery' => 'GLR-005',
                'description'  => 'Galeri koleksi batik eksklusif dengan motif nusantara yang kaya akan nilai seni dan budaya Indonesia.',
                'is_active'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'title'        => 'Pop-Up Store Surabaya',
                'image'        => 'gallery/popup-surabaya.jpg',
                'code_gallery' => 'GLR-006',
                'description'  => 'Dokumentasi kegiatan pop-up store Hema Indonesia di Tunjungan Plaza Surabaya yang berlangsung meriah.',
                'is_active'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'title'        => 'Lookbook Jaket Winter Edition',
                'image'        => 'gallery/lookbook-jaket.jpg',
                'code_gallery' => 'GLR-007',
                'description'  => 'Lookbook koleksi jaket edisi winter, menampilkan berbagai gaya pemakaian yang stylish dan hangat.',
                'is_active'    => false,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
