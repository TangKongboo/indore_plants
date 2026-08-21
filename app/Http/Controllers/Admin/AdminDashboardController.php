<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPlants = Plant::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'Paid')->sum('total_amount');
        $pendingOrdersCount = Order::where('order_status', 'Pending')->count();
        
        $recentOrders = Order::with('items')->latest()->take(5)->get();
        $topPlants = Plant::with('category')->orderBy('stock', 'desc')->take(5)->get();

        // Chart Data: Revenue Last 7 Days
        $revenueData = [];
        $revenueLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
            $revenueLabels[] = \Carbon\Carbon::now()->subDays($i)->format('M d');
            $revenueData[] = Order::where('payment_status', 'Paid')
                ->whereDate('created_at', $date)
                ->sum('total_amount');
        }

        // Chart Data: Plants by Category
        $categoriesChart = Category::withCount('plants')->get();
        $catLabels = $categoriesChart->pluck('name')->toArray();
        $catData = $categoriesChart->pluck('plants_count')->toArray();

        return view('admin.dashboard', compact(
            'totalPlants',
            'totalCategories',
            'totalOrders',
            'totalRevenue',
            'pendingOrdersCount',
            'recentOrders',
            'topPlants',
            'revenueLabels',
            'revenueData',
            'catLabels',
            'catData'
        ));
    }
}
