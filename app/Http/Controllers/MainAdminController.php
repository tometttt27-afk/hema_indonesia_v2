<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
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

        $totalProducts = ProductsModel::count();
        $outOfStockCount = ProductsModel::whereNotNull('stock')->where('stock', '<=', 0)->count();

        return view('dashboard.main', compact(
            'lowStockProducts',
            'totalProducts',
            'outOfStockCount',
            'lowStockThreshold'
        ));
    }
}
