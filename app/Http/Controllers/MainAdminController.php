<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\ProductsModel;
use App\Models\User;
use Illuminate\Http\Request;

class MainAdminController extends Controller
{
    public function index()
    {
        $lowStockThreshold = 5;

        $lowStockProducts = ProductsModel::with('categories')
            ->whereNotNull('stock')
            ->where('stock', '<=', $lowStockThreshold)
            ->orderBy('stock')
            ->get();

        $totalProducts    = ProductsModel::count();
        $outOfStockCount  = ProductsModel::whereNotNull('stock')->where('stock', '<=', 0)->count();
        $totalOrders      = class_exists(OrderModel::class) ? OrderModel::count() : 0;
        $totalCustomers   = User::where('role', 'customer')->count();

        return view('dashboard.main', compact(
            'lowStockProducts',
            'totalProducts',
            'outOfStockCount',
            'lowStockThreshold',
            'totalOrders',
            'totalCustomers'
        ));
    }
}
