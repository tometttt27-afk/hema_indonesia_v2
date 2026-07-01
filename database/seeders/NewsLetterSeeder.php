<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsLetterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('news_letter')->insert([
            ['email' => 'budi.santoso@gmail.com',       'created_at' => now(), 'updated_at' => now()],
            ['email' => 'siti.rahayu@gmail.com',        'created_at' => now(), 'updated_at' => now()],
            ['email' => 'andi.wijaya@yahoo.com',        'created_at' => now(), 'updated_at' => now()],
            ['email' => 'dewi.lestari@gmail.com',       'created_at' => now(), 'updated_at' => now()],
            ['email' => 'rizky.firmansyah@gmail.com',   'created_at' => now(), 'updated_at' => now()],
            ['email' => 'nurul.hidayah@gmail.com',      'created_at' => now(), 'updated_at' => now()],
            ['email' => 'hendra.kusuma@outlook.com',    'created_at' => now(), 'updated_at' => now()],
            ['email' => 'pelanggan.setia@gmail.com',    'created_at' => now(), 'updated_at' => now()],
            ['email' => 'fashionlover99@gmail.com',     'created_at' => now(), 'updated_at' => now()],
            ['email' => 'stylista.indonesia@gmail.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
