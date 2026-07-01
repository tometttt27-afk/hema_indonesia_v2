<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name'          => 'Kaos',
                'category_code' => 'CAT-001',
                'description'   => 'Koleksi kaos pria dan wanita berbahan cotton combed berkualitas tinggi, nyaman dipakai sehari-hari.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Kemeja',
                'category_code' => 'CAT-002',
                'description'   => 'Koleksi kemeja formal dan casual untuk berbagai kesempatan, tersedia dalam berbagai motif dan warna.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Celana',
                'category_code' => 'CAT-003',
                'description'   => 'Koleksi celana panjang dan pendek pria wanita, mulai dari chino, jeans, hingga celana training.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Dress',
                'category_code' => 'CAT-004',
                'description'   => 'Koleksi dress wanita elegan dan kasual, cocok untuk berbagai kesempatan mulai dari santai hingga formal.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Jaket',
                'category_code' => 'CAT-005',
                'description'   => 'Koleksi jaket pria dan wanita berbahan premium, tersedia dalam berbagai model seperti bomber, hoodie, dan varsity.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Hijab',
                'category_code' => 'CAT-006',
                'description'   => 'Koleksi hijab modern dengan berbagai pilihan bahan dan model, cocok untuk tampilan sehari-hari maupun acara spesial.',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
