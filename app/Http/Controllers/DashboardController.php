<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    // =====================
    // Views
    // =====================
    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $recentProducts = Product::latest()->take(5)->get();
        return view('pages.dashboard.index', compact('productCount', 'categoryCount', 'recentProducts'));
    }
}
