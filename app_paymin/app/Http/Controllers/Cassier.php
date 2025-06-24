<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Auth;
use App\Models\Mdl_Admin;
use App\Models\Mdl_Sales;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Cassier extends BaseController
{
    // HOME / DASHBOARD
    public function home()
    {
        $userId = session('user_id');
        $user = Mdl_Admin::where('id', $userId)->first();

        $admissionFee = DB::table('payments')->sum('amount');
        $TotalItems = DB::table('products')->count();
        $TotalCustomers = DB::table('customers')->count();

        $products = DB::table('products')->get();

        $salesGrowth = DB::table('sale_items')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->join('products', 'sale_items.product_id', '=', 'products.id')
            ->where('sales.sale_date', '>=', Carbon::now()->subDays(7))
            ->select('products.name', 'products.stock', DB::raw('SUM(sale_items.quantity) as total_quantity'))
            ->groupBy('products.id', 'products.name', 'products.stock')
            ->orderByDesc('total_quantity')
            ->take(7) 
            ->get();

        $lowStocks = DB::table('products')
            ->where('stock', '<=', 5)
            ->get();

        $ordersToday = DB::table('sales')
            ->whereDate('sale_date', Carbon::today())
            ->get();
        
        return view('cassierpage/home',  compact('user', 'admissionFee', 'TotalItems', 'TotalCustomers', 'TotalCustomers', 'products', 'lowStocks', 'ordersToday', 'salesGrowth'));
    }


    // ORDERS
    public function order()
    {
        $product = DB::table('products')->get();

        return view('cassierpage/order', compact('product'));
    }



    // REPORT
    public function report() {
        $user = Mdl_Admin::all();
        // $user = Mdl_Sales::with('users')->get();
        $sales = Mdl_Sales::all();
        $sales = Mdl_Sales::with('user')->get();

        $today = Carbon::today();

        $beginningBalance = DB::table('balances')->whereDate('date', $today)->value('beginning_balance') ?? 0;

        $admissionFee = DB::table('payments')
            ->whereDate('created_at', $today)
            ->sum('amount');

        $moneyOut = DB::table('expenses')
            ->whereDate('created_at', $today)
            ->sum('amount');

        return view('karyawanpage/report', compact('user', 'sales', 'beginningBalance', 'admissionFee', 'moneyOut'));
    }

    // ITEMS
    public function item() {

        $outOfStock = DB::table('products')
            ->where('stock', '<=', 0)
            ->count();

        $lowStock = DB::table('products')
            ->where('stock', '<=', 5)
            ->where('stock', '>', 0)
            ->count();

        $totalProducts = DB::table('products')->count();

        $categories = DB::table('categories')->get();
        $products = DB::table('products')->get();

        return view('karyawanpage/items',compact('outOfStock', 'lowStock', 'totalProducts', 'categories', 'products'));
    }

    // MEMBERSHIP
    public function member()
    {
        $members = Mdl_Admin::all();
        return view('karyawanpage/member', compact('members'));
    }


    // SETTINGS
    public function setting()
    {
        $userId = session('user_id');
        $user = Mdl_Admin::where('id', $userId)->first();
        
        return view('karyawanpage/setting', compact('user'));
    }
}