<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\SupportFeedback;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        // Get statistics
        $totalUsers = User::where('is_admin', false)->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        
        // Get recent data
        $recentUsers = User::where('is_admin', false)->latest()->take(5)->get();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentFeedback = SupportFeedback::latest()->take(5)->get();
        
        // Get low stock products
        $lowStockProducts = Product::where('quantity', '<', 10)->orderBy('quantity')->take(5)->get();
        
        // Get active promotions
        $activePromotions = Promotion::where('is_active', true)->get();
        
        // Get orders by status
        $ordersByStatus = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');
        
        // Get monthly revenue (last 6 months)
        $driver = DB::getDriverName();
        $dateFormat = $driver === 'sqlite' 
            ? "strftime('%Y-%m', created_at)" 
            : "DATE_FORMAT(created_at, '%Y-%m')";
        
        $monthlyRevenue = Order::where('status', 'completed')
            ->where('created_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw("{$dateFormat} as month"),
                DB::raw('SUM(total_amount) as revenue')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'recentUsers',
            'recentOrders',
            'recentFeedback',
            'lowStockProducts',
            'activePromotions',
            'ordersByStatus',
            'monthlyRevenue'
        ));
    }
}
