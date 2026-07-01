<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        // ── Orders ─────────────────────────────────────────────────────────
        // user_id: 2=Budi, 3=Siti, 4=Andi, 5=Dewi, 6=Rizky, 7=Nurul, 8=Hendra
        DB::table('orders')->insert([
            [
                'user_id'           => 2,
                'total_price'       => 333000,
                'status'            => 'completed',
                'snap_token'        => null,
                'midtrans_order_id' => 'HEMA-20260101-001',
                'payment_type'      => 'bank_transfer',
                'paid_at'           => now()->subDays(30),
                'tracking_number'   => 'JNE-1234567890',
                'created_at'        => now()->subDays(31),
                'updated_at'        => now()->subDays(28),
            ],
            [
                'user_id'           => 3,
                'total_price'       => 450000,
                'status'            => 'shipped',
                'snap_token'        => null,
                'midtrans_order_id' => 'HEMA-20260110-002',
                'payment_type'      => 'gopay',
                'paid_at'           => now()->subDays(10),
                'tracking_number'   => 'SICEPAT-9876543210',
                'created_at'        => now()->subDays(12),
                'updated_at'        => now()->subDays(9),
            ],
            [
                'user_id'           => 4,
                'total_price'       => 614500,
                'status'            => 'paid',
                'snap_token'        => null,
                'midtrans_order_id' => 'HEMA-20260115-003',
                'payment_type'      => 'credit_card',
                'paid_at'           => now()->subDays(5),
                'tracking_number'   => null,
                'created_at'        => now()->subDays(6),
                'updated_at'        => now()->subDays(5),
            ],
            [
                'user_id'           => 5,
                'total_price'       => 265500,
                'status'            => 'pending',
                'snap_token'        => 'snap-token-dummy-dewi-001',
                'midtrans_order_id' => 'HEMA-20260120-004',
                'payment_type'      => null,
                'paid_at'           => null,
                'tracking_number'   => null,
                'created_at'        => now()->subDays(1),
                'updated_at'        => now()->subDays(1),
            ],
            [
                'user_id'           => 6,
                'total_price'       => 762500,
                'status'            => 'completed',
                'snap_token'        => null,
                'midtrans_order_id' => 'HEMA-20260105-005',
                'payment_type'      => 'qris',
                'paid_at'           => now()->subDays(20),
                'tracking_number'   => 'ANTERAJA-5566778899',
                'created_at'        => now()->subDays(22),
                'updated_at'        => now()->subDays(18),
            ],
            [
                'user_id'           => 7,
                'total_price'       => 175250,
                'status'            => 'cancelled',
                'snap_token'        => null,
                'midtrans_order_id' => 'HEMA-20260108-006',
                'payment_type'      => null,
                'paid_at'           => null,
                'tracking_number'   => null,
                'created_at'        => now()->subDays(15),
                'updated_at'        => now()->subDays(14),
            ],
            [
                'user_id'           => 2,
                'total_price'       => 224000,
                'status'            => 'paid',
                'snap_token'        => null,
                'midtrans_order_id' => 'HEMA-20260118-007',
                'payment_type'      => 'bank_transfer',
                'paid_at'           => now()->subDays(3),
                'tracking_number'   => null,
                'created_at'        => now()->subDays(4),
                'updated_at'        => now()->subDays(3),
            ],
        ]);

        // ── Detail Orders ──────────────────────────────────────────────────
        // order 1 (Budi - completed): total 333.000
        //   PRD-006 Celana Chino qty:1 = 225.000  +  PRD-001 Kaos Polos qty:1 = 108.000
        // order 2 (Siti - shipped): total 450.000
        //   PRD-008 Midi Dress qty:1 = 350.000  +  PRD-012 Hijab Voal qty:1 = 85.000  + PRD-013 Hijab Pashmina qty:1 = 90.250 (dibulatkan jadi total 450k pakai harga asli)
        // order 3 (Andi - paid): total 614.500
        //   PRD-010 Jaket Bomber qty:1 = 382.500  +  PRD-005 Kemeja Flannel qty:1 = 210.000 + PRD-012 Hijab Voal qty:1 = ??? => pakai PRD-006 + PRD-010
        // order 4 (Dewi - pending): total 265.500
        //   PRD-009 Maxi Dress qty:1 = 265.500
        // order 5 (Rizky - completed): total 762.500
        //   PRD-010 Jaket Bomber qty:1 = 382.500  +  PRD-007 Jeans qty:1 = 240.000  +  PRD-011 Hoodie qty:1 = 380.000 (total 1.002.500 — let's use realistic subset)
        //   PRD-010 qty:1 = 382.500  +  PRD-007 qty:1 = 240.000  +  PRD-001 Kaos qty:1 = 108.000 + PRD-006 qty:1 = 225.000 pakai PRD-010+PRD-007+PRD-004+PRD-006
        // order 6 (Nurul - cancelled): total 175.250
        //   PRD-013 Hijab Pashmina qty:1 = 90.250  +  PRD-001 Kaos qty:1 = 108.000 (~ 198k, pakai PRD-012 + PRD-001 = 85+108 = 193, or just PRD-013 + PRD-012)
        // order 7 (Budi - paid): total 224.000
        //   PRD-004 Kemeja Batik qty:1 = 224.000

        DB::table('detail_orders')->insert([
            // Order 1 – Budi – completed
            [
                'order_id'   => 1,
                'product_id' => 6,
                'size'       => '32',
                'quantity'   => 1,
                'price'      => 225000,
                'created_at' => now()->subDays(31),
                'updated_at' => now()->subDays(31),
            ],
            [
                'order_id'   => 1,
                'product_id' => 1,
                'size'       => 'L',
                'quantity'   => 1,
                'price'      => 108000,
                'created_at' => now()->subDays(31),
                'updated_at' => now()->subDays(31),
            ],

            // Order 2 – Siti – shipped
            [
                'order_id'   => 2,
                'product_id' => 8,
                'size'       => 'M',
                'quantity'   => 1,
                'price'      => 350000,
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            [
                'order_id'   => 2,
                'product_id' => 12,
                'size'       => 'All Size',
                'quantity'   => 1,
                'price'      => 85000,
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],

            // Order 3 – Andi – paid
            [
                'order_id'   => 3,
                'product_id' => 10,
                'size'       => 'XL',
                'quantity'   => 1,
                'price'      => 382500,
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'order_id'   => 3,
                'product_id' => 5,
                'size'       => 'L',
                'quantity'   => 1,
                'price'      => 210000,
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],

            // Order 4 – Dewi – pending
            [
                'order_id'   => 4,
                'product_id' => 9,
                'size'       => 'S',
                'quantity'   => 1,
                'price'      => 265500,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],

            // Order 5 – Rizky – completed
            [
                'order_id'   => 5,
                'product_id' => 10,
                'size'       => 'L',
                'quantity'   => 1,
                'price'      => 382500,
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],
            [
                'order_id'   => 5,
                'product_id' => 7,
                'size'       => '30',
                'quantity'   => 1,
                'price'      => 240000,
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],
            [
                'order_id'   => 5,
                'product_id' => 11,
                'size'       => 'M',
                'quantity'   => 1,
                'price'      => 140000,
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],

            // Order 6 – Nurul – cancelled
            [
                'order_id'   => 6,
                'product_id' => 13,
                'size'       => 'All Size',
                'quantity'   => 1,
                'price'      => 90250,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'order_id'   => 6,
                'product_id' => 1,
                'size'       => 'M',
                'quantity'   => 1,
                'price'      => 85000,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],

            // Order 7 – Budi – paid
            [
                'order_id'   => 7,
                'product_id' => 4,
                'size'       => 'M',
                'quantity'   => 1,
                'price'      => 224000,
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
        ]);
    }
}
