<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsEmailSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('news_email')->insert([
            ['email' => 'promo@hema.id',          'created_at' => now(), 'updated_at' => now()],
            ['email' => 'newsletter@hema.id',      'created_at' => now(), 'updated_at' => now()],
            ['email' => 'info@hema.id',            'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
