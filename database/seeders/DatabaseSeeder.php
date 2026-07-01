<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Urutan penting: tabel yang menjadi referensi FK harus di-seed terlebih dahulu.
     *  1. AboutCompanySeeder   – tidak ada FK
     *  2. CategoriesSeeder     – tidak ada FK
     *  3. UserSeeder           – tidak ada FK
     *  4. ProductsSeeder       – FK -> categories
     *  5. OrdersSeeder         – FK orders -> users | FK detail_orders -> orders, products
     *  6. WishlistSeeder       – FK -> users, products
     *  7. GallerySeeder        – tidak ada FK
     *  8. NewsEmailSeeder      – tidak ada FK
     *  9. NewsLetterSeeder     – tidak ada FK
     * 10. FaqCompanySeeder     – tidak ada FK
     */
    public function run(): void
    {
        $this->call([
            AboutCompanySeeder::class,
            CategoriesSeeder::class,
            UserSeeder::class,
            ProductsSeeder::class,
            OrdersSeeder::class,
            WishlistSeeder::class,
            GallerySeeder::class,
            NewsEmailSeeder::class,
            NewsLetterSeeder::class,
            FaqCompanySeeder::class,
        ]);
    }
}
