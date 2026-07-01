<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('wishlist')->insert([
            // Budi (user_id=2)
            ['user_id' => 2, 'product_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'product_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'product_id' => 7,  'created_at' => now(), 'updated_at' => now()],

            // Siti (user_id=3)
            ['user_id' => 3, 'product_id' => 9,  'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'product_id' => 13, 'created_at' => now(), 'updated_at' => now()],

            // Andi (user_id=4)
            ['user_id' => 4, 'product_id' => 4,  'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 4, 'product_id' => 6,  'created_at' => now(), 'updated_at' => now()],

            // Dewi (user_id=5)
            ['user_id' => 5, 'product_id' => 8,  'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 5, 'product_id' => 12, 'created_at' => now(), 'updated_at' => now()],

            // Rizky (user_id=6)
            ['user_id' => 6, 'product_id' => 3,  'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 6, 'product_id' => 5,  'created_at' => now(), 'updated_at' => now()],

            // Nurul (user_id=7)
            ['user_id' => 7, 'product_id' => 1,  'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 7, 'product_id' => 2,  'created_at' => now(), 'updated_at' => now()],

            // Hendra (user_id=8)
            ['user_id' => 8, 'product_id' => 10, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
