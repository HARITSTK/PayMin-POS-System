<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Admin;
use App\Models\Mdl_Member;
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

class Admin extends BaseController
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

        $ordersToday = DB::table('sales')
            ->whereDate('sale_date', Carbon::today())
            ->get();
        
        return view('adminpage/home',  compact('user', 'admissionFee', 'TotalItems', 'TotalCustomers', 'TotalCustomers', 'products', 'lowStocks', 'ordersToday', 'salesGrowth'));
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

        return view('adminpage/items',compact('outOfStock', 'lowStock', 'totalProducts', 'products', 'categories', 'subcategories'));
    }

    public function SysAddItem(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:100',
        'desc' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'nullable|exists:subcategories,id',
        // 'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // if ($request->hasFile('image')) {
        //     $filename = time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('uploads/products'), $filename);
        //     $validated['image'] = $filename;
        // }
        
        Mdl_Product::create($validated);
        
        return redirect()->back()->with('message', 'Item berhasil ditambahkan');
    }

    public function SysDeleteItem(Request $request)
    {
        $id = $request->id;

        $product = Mdl_Product::findOrFail($id);

        // Hapus gambar jika ada
        if ($product->image) {
            $path = public_path('uploads/products/' . $product->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $product->delete();

        return redirect()->back()->with('message', 'Produk berhasil dihapus');
    }

    public function SysEditItem(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'desc' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        $product = Mdl_Product::findOrFail($validated['id']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                $path = public_path('uploads/products/' . $product->image);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $filename = time() . '_' . Str::slug($request->name) . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $filename);
            $validated['image'] = $filename;
        } else {
            unset($validated['image']);
        }

        $product->update($validated);

        return redirect()->back()->with('message', 'Item berhasil diperbarui');
    }

 

    // REPORT
    public function report() {
        $user = Mdl_Admin::all();
        // $user = Mdl_Sales::with('users')->get();
        $sales = Mdl_Sales::all();
        $sales = Mdl_Sales::with('user')->get();

        // $today = Carbon::today();

        // $beginningBalance = DB::table('balances')->whereDate('date', $today)->value('beginning_balance') ?? 0;
        $TotalIncome = DB::table('sales')->where('total')->count();
        $TotalItemSell = DB::table('sale_items')->where('product_id')->count();
        $TotalCustomers = DB::table('customers')->count();

        return view('adminpage/report', compact('user', 'sales', 'TotalCustomers', 'TotalItemSell', 'TotalIncome'));
    }

    public function exportCSVReport()
    {
        $fileName = 'Report_Data_' . now()->format('Ymd_His') . '.csv';
        $users = Mdl_Sales::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['id:Username', 'customer id', 'total', 'payment', 'sale date', 'type', 'quantity'];

        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->user_id,
                    $user->customer_id,
                    $user->total,
                    $user->payment,
                    $user->sale_date->format('Y-m-d H:i:s'),
                    $user->type,
                    $user->quantity,
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }



    // MASTER
    public function master() {
        $masterdata = Mdl_Admin::all();

        return view('adminpage/masterkey', compact('masterdata'));
    }

    public function SysAddMaster(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'role' => 'required',
                'username' => 'required|min:5',
                'name' => 'required|min:5',
                'password' => 'required|min:8',
                'photo' => 'nullable|image|mimes:png|max:2048',
            ]);

            if ($request->hasFile('photo')) {
                $photoFile = $request->file('photo');
                $photoName = uniqid() . '.' . $photoFile->getClientOriginalExtension();
                $photoFile->storeAs('public/uploads/photos', $photoName);
                $validatedData['photo'] = $photoName;
            } else {
                $validatedData['photo'] = null;
            }
            
            Mdl_Admin::AddDataMaster($validatedData);
            
            return redirect()->route('Master')->with('message', 'Data User berhasil ditambahkan');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Gagal menambahkan data user: ' . $e->getMessage());
        }
    }

    public function SysDeleteMaster(Request $request)
    {
        $user = Mdl_Admin::find($request->id);
        // dd($user);
        if ($user) {
            if ($user->photo) {
                // Storage::delete('public/uploads/photos/' . $user->photo);
            }

            $user->delete();
            return redirect()->route('Master')->with('message', 'User berhasil dihapus');
        }

        return redirect()->route('Master')->with('message', 'User tidak ditemukan');
    }

    public function SysEditMaster(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|max:255',
            'username' => 'nullable|max:255', 
            'role' => 'nullable|in:admin,karyawan',
            'password' => 'nullable|min:8',
        ]);

        
        $user = Mdl_Admin::CekId($id);
        // dd($user);
        
        if (!$user) {
            return redirect()->back()->with('message', 'User tidak ditemukan.');
        }
        
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username']; 
        $user->role = $validatedData['role'];
        $user->updated_at = date('Y-m-d H:i:s');

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();
        
        return redirect()->back()->with('message', 'Data user berhasil diperbarui.');
    }

    public function exportCSVMaster()
    {
        $fileName = 'Master_Data_' . now()->format('Ymd_His') . '.csv';
        $users = Mdl_Admin::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Name', 'Username', 'Role', 'Is Active', 'Created At', 'Updated At', 'Bio'];

        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->name,
                    $user->username,
                    // $user->password,
                    $user->role,
                    $user->is_active ? 'Active' : 'Inactive',
                    $user->created_at->format('Y-m-d H:i:s'),
                    $user->updated_at->format('Y-m-d H:i:s'),
                    $user->bio ?? '-',
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }



    // PROFILE / SETTINGS
    public function setting() {
        $userId = session('user_id');
        $user = Mdl_Admin::where('id', $userId)->first();
        
        return view('adminpage/setting', compact('user'));
    }

    public function SysEditProfile(Request $request) {        
        $userId = session('user_id');
        $user = Mdl_Admin::find($userId);
        
        if (!$user) {
            return redirect()->back()->with('message', 'User tidak ditemukan.');
        }

        $validatedData = $request->validate([
            'name' => 'nullable|max:255',
            'username' => 'nullable|max:255', 
            'bio' => 'nullable',
        ]);
        
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->bio = $validatedData['bio'];
        $user->save();

        session([
            'name_admin' => $user->name,
            'username_admin' => $user->username,
            'bio_admin' => $user->bio,
        ]);
        
        return redirect()->back()->with('message', 'Data user berhasil diperbarui.');
    }

    public function SysUpdatePassword(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_repeat' => 'required|same:new_password',
        ]);
        
        if ($validator->fails()) {
            return back()->with('message', $validator->errors()->first());
        }

        $userId = session('user_id');
        $user = Mdl_Admin::find($userId);

        if (!$user) {
            return back()->with('message', 'User not found.');
        }

        if (!password_verify($request->old_password, $user->password)) {
            return back()->with('message', 'Old Password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('message', 'Password successfully updated.');

    }



    // MEMBERSHIP
    public function member() {
        $members = Mdl_Admin::all();
        return view('adminpage/member', compact('members'));
    }


    public function exportCSVMember() {
        $fileName = 'Membership_Data_' . now()->format('Ymd_His') . '.csv';
        $users = Mdl_Member::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Customer id', 'Membership Type', 'Amount', 'Point', 'Created At', 'Updated At'];

        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->customer_id,
                    $user->membership_type,
                    $user->membership_date->format('Y-m-d H:i:s'),
                    $user->amount,
                    $user->points,
                    $user->created_at->format('Y-m-d H:i:s'),
                    $user->updated_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}