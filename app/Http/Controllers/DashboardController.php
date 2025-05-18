<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stocki;
use App\Models\Stocko;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total products count
        $totalProducts = Product::count();
        
        // Get total stock in value
        $totalStockInValue = Stocki::sum('totalprice');
        
        // Get total stock out value
        $totalStockOutValue = Stocko::sum('totalprice');
        
        // Get recent stock in transactions
        $recentStockIn = Stocki::with('product')
            ->latest()
            ->take(5)
            ->get();
        
        // Get recent stock out transactions
        $recentStockOut = Stocko::with('product')
            ->latest()
            ->take(5)
            ->get();
        
        return view('dashboard', compact(
            'totalProducts',
            'totalStockInValue',
            'totalStockOutValue',
            'recentStockIn',
            'recentStockOut'
        ));
    }
}
