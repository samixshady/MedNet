<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Detect database driver for proper SQL syntax
        $driver = DB::connection()->getDriverName();
        
        // Sales & Revenue
        $totalSales = Order::where('payment_status', 'paid')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        
        // Monthly revenue for last 6 months
        $monthDateFormat = $driver === 'sqlite' 
            ? "strftime('%Y-%m', created_at)" 
            : "DATE_FORMAT(created_at, '%Y-%m')";
            
        $monthlyRevenue = Order::where('payment_status', 'paid')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->select(
                DB::raw("$monthDateFormat as month"),
                DB::raw('SUM(total_amount) as revenue')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        
        // Best selling products (top 5)
        $bestSellingProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->with('product')
            ->get();
        
        // Orders Overview
        $totalOrders = Order::count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $completedOrders = Order::where('order_status', 'delivered')->count();
        $cancelledOrders = Order::whereIn('order_status', ['cancelled', 'failed'])->count();
        
        // Orders trend for last 7 days
        $dateFormat = $driver === 'sqlite' 
            ? "date(created_at)" 
            : "DATE(created_at)";
            
        $ordersTrend = Order::where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(
                DB::raw("$dateFormat as date"),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        // Users & Customers
        $totalUsers = User::count();
        $newUsersThisMonth = User::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
        $activeCustomers = User::whereHas('orders')->count();
        
        // New vs Returning customers
        $newCustomers = User::whereHas('orders', function($query) {
            $query->select('user_id')
                ->groupBy('user_id')
                ->havingRaw('COUNT(*) = 1');
        })->count();
        
        $returningCustomers = User::whereHas('orders', function($query) {
            $query->select('user_id')
                ->groupBy('user_id')
                ->havingRaw('COUNT(*) > 1');
        })->count();
        
        // Inventory / Products
        $totalProducts = Product::count();
        $outOfStockProducts = Product::where('stock_status', 'out_of_stock')->count();
        $lowStockProducts = Product::where('stock_status', 'low_stock')
            ->orWhere(function($query) {
                $query->whereColumn('quantity', '<=', 'low_stock_threshold');
            })
            ->select('id', 'name', 'quantity')
            ->limit(10)
            ->get();
        
        // Prescription Orders
        $prescriptionOrders = OrderItem::whereHas('product', function($query) {
            $query->where('prescription_required', true);
        })->distinct('order_id')->count('order_id');
        
        // Assuming pending prescription approvals are orders with prescription items that are pending
        $pendingPrescriptionApprovals = Order::where('order_status', 'pending')
            ->whereHas('items.product', function($query) {
                $query->where('prescription_required', true);
            })
            ->count();
        
        // Recent activity (last 10 orders)
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('admin.analytics', compact(
            'totalSales',
            'totalRevenue',
            'monthlyRevenue',
            'bestSellingProducts',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'ordersTrend',
            'totalUsers',
            'newUsersThisMonth',
            'activeCustomers',
            'newCustomers',
            'returningCustomers',
            'totalProducts',
            'outOfStockProducts',
            'lowStockProducts',
            'prescriptionOrders',
            'pendingPrescriptionApprovals',
            'recentOrders'
        ));
    }
}
