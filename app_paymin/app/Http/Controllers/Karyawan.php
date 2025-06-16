<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Auth;
use App\Models\Mdl_Admin;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Karyawan extends BaseController
{
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
        
        return view('karyawanpage/home',  compact('user', 'admissionFee', 'TotalItems', 'TotalCustomers', 'TotalCustomers', 'products', 'lowStocks', 'ordersToday', 'salesGrowth'));
    }

    public function order()
    {
        return view('karyawanpage/order');
    }

    public function member()
    {
        $members = Mdl_Admin::all();
        return view('karyawanpage/member', compact('members'));
    }

    public function setting()
    {
        $userId = session('user_id');
        $user = Mdl_Admin::where('id', $userId)->first();
        
        return view('karyawanpage/setting', compact('user'));
    }
}