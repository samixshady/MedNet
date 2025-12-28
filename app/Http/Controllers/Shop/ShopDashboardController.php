<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopDashboardController extends Controller
{
    public function index()
    {
        $pharmacy = Auth::guard('pharmacy')->user();
        $totalProducts = Product::where('pharmacy_id', $pharmacy->id)->count();
        $medicineCount = Product::where('pharmacy_id', $pharmacy->id)->where('category', 'medicine')->count();
        $supplementCount = Product::where('pharmacy_id', $pharmacy->id)->where('category', 'supplement')->count();
        $firstAidCount = Product::where('pharmacy_id', $pharmacy->id)->where('category', 'first_aid')->count();

        return view('shop.dashboard', compact(
            'pharmacy',
            'totalProducts',
            'medicineCount',
            'supplementCount',
            'firstAidCount'
        ));
    }
}
