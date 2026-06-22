<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\ProductsModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MainAdminController extends Controller
{
    public function index()
    {
        $lowStockThreshold = 5;

        // ── Produk stok menipis/habis ─────────────────────────────
        $lowStockProducts = ProductsModel::with('categories')
            ->whereNotNull('stock')
            ->where('stock', '<=', $lowStockThreshold)
            ->orderBy('stock', 'asc')
            ->get();

        // ── Metrik ringkasan (COUNT/SUM dari DB) ──────────────────
        $totalProducts   = ProductsModel::count();
        $outOfStockCount = ProductsModel::whereNotNull('stock')
                                        ->where('stock', '<=', 0)
                                        ->count();
        $totalOrders     = OrderModel::count();
        $totalCustomers  = User::where('role', 'customer')->count();

        // Total pendapatan: hanya dari pesanan yang sudah dibayar/selesai
        $totalRevenue = OrderModel::whereIn('status', ['paid', 'shipped', 'completed'])
                                  ->sum('total_price');

        // Pesanan bulan ini vs bulan lalu (untuk persentase naik/turun)
        $ordersThisMonth = OrderModel::whereMonth('created_at', now()->month)
                                     ->whereYear('created_at',  now()->year)
                                     ->count();
        $ordersLastMonth = OrderModel::whereMonth('created_at', now()->subMonth()->month)
                                     ->whereYear('created_at',  now()->subMonth()->year)
                                     ->count();
        $orderGrowth = $ordersLastMonth > 0
            ? round((($ordersThisMonth - $ordersLastMonth) / $ordersLastMonth) * 100, 1)
            : ($ordersThisMonth > 0 ? 100 : 0);

        // Revenue bulan ini
        $revenueThisMonth = OrderModel::whereIn('status', ['paid', 'shipped', 'completed'])
                                      ->whereMonth('created_at', now()->month)
                                      ->whereYear('created_at',  now()->year)
                                      ->sum('total_price');

        // ── Pesanan terbaru (6 teratas) untuk panel aktivitas ─────
        $recentOrders = OrderModel::with('user')
                                  ->latest()
                                  ->take(6)
                                  ->get();

        // ── Pesanan per-status (untuk mini progress bar) ──────────
        $ordersByStatus = OrderModel::select('status', DB::raw('count(*) as total'))
                                    ->groupBy('status')
                                    ->pluck('total', 'status')
                                    ->toArray();

        return view('dashboard.main', compact(
            'lowStockProducts',
            'lowStockThreshold',
            'totalProducts',
            'outOfStockCount',
            'totalOrders',
            'totalCustomers',
            'totalRevenue',
            'ordersThisMonth',
            'orderGrowth',
            'revenueThisMonth',
            'recentOrders',
            'ordersByStatus',
        ));
    }
}
