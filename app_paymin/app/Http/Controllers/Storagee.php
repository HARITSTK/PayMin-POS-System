<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Admin;
use App\Models\Mdl_Sales;
use App\Models\Mdl_Product;
use App\Models\Mdl_Categories;
use App\Models\Mdl_SubCategories;
// use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Storagee extends BaseController
{
    // DASHBOARD / HOME
    public function home() {
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

        $ordersToday = Mdl_Sales::with(['saleItems.product'])
            ->whereDate('sale_date', Carbon::today())
            ->get();

        
        return view('storagepage/home',  compact('user', 'admissionFee', 'TotalItems', 'TotalCustomers', 'TotalCustomers', 'products', 'lowStocks', 'ordersToday', 'salesGrowth'));
    }

    // ITEM
    public function item() {

        $outOfStock = DB::table('products')
            ->where('stock', '<=', 0)
            ->count();

        $lowStock = DB::table('products')
            ->where('stock', '<=', 5)
            ->where('stock', '>', 0)
            ->count();

        $totalProducts = DB::table('products')->count();

        // $categories = DB::table('categories')->get();
        $products = Mdl_Product::with('category')->get();
        $categories = Mdl_Categories::all();
        $subcategories = Mdl_SubCategories::select('id', 'category_id', 'name')->get()->groupBy('category_id');

        return view('storagepage/items',compact('outOfStock', 'lowStock', 'totalProducts', 'products', 'categories', 'subcategories'));
    }

    // PROFILE / SETTINGS
    public function setting() {
        $userId = session('user_id');
        $user = Mdl_Admin::where('id', $userId)->first();
        
        return view('storagepage/setting', compact('user'));
    }

    // public function SysEditProfile(Request $request) {        
    //     $userId = session('user_id');
    //     $user = Mdl_Admin::find($userId);
        
    //     if (!$user) {
    //         return redirect()->back()->with('message', 'User tidak ditemukan.');
    //     }

    //     $validatedData = $request->validate([
    //         'name' => 'nullable|max:255',
    //         'username' => 'nullable|max:255', 
    //         'bio' => 'nullable',
    //     ]);
        
    //     $user->name = $validatedData['name'];
    //     $user->username = $validatedData['username'];
    //     $user->bio = $validatedData['bio'];
    //     $user->save();

    //     session([
    //         'name_admin' => $user->name,
    //         'username_admin' => $user->username,
    //         'bio_admin' => $user->bio,
    //     ]);
        
    //     return redirect()->back()->with('message', 'Data user berhasil diperbarui.');
    // }

    // public function SysUpdatePassword(Request $request) {
        
    //     $validator = Validator::make($request->all(), [
    //         'old_password' => 'required',
    //         'new_password' => 'required|min:8',
    //         'new_password_repeat' => 'required|same:new_password',
    //     ]);
        
    //     if ($validator->fails()) {
    //         return back()->with('message', $validator->errors()->first());
    //     }

    //     $userId = session('user_id');
    //     $user = Mdl_Admin::find($userId);

    //     if (!$user) {
    //         return back()->with('message', 'User not found.');
    //     }

    //     if (!password_verify($request->old_password, $user->password)) {
    //         return back()->with('message', 'Old Password is incorrect.');
    //     }

    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return back()->with('message', 'Password successfully updated.');

    // }
}