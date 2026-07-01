<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutCompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('about_company')->insert([
            [
                'name'                        => 'Hema Indonesia',
                'logo'                        => 'logo/hema-logo.png',
                'breadcrumb'                  => 'breadcrumb/breadcrumb-about.jpg',
                'about_description_company'   => 'Hema Indonesia adalah brand fashion lokal yang berdiri sejak tahun 2018, menghadirkan koleksi pakaian modern dengan sentuhan budaya Indonesia. Kami berkomitmen untuk menyediakan produk berkualitas tinggi dengan harga terjangkau bagi seluruh lapisan masyarakat Indonesia. Setiap produk kami dirancang dengan penuh dedikasi oleh desainer lokal berbakat yang memahami selera dan kebutuhan pelanggan Indonesia.',
                'about_img_company'           => 'about/about-company.jpg',
                'instagram'                   => 'https://www.instagram.com/hema.indonesia',
                'tiktok'                      => 'https://www.tiktok.com/@hema.indonesia',
                'facebook'                    => 'https://www.facebook.com/hemaindonesia',
                'youtube'                     => 'https://www.youtube.com/@hemaindonesia',
                'created_at'                  => now(),
                'updated_at'                  => now(),
            ],
        ]);
    }
}
