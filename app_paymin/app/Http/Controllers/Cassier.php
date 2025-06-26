<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Auth;
use App\Models\Mdl_Admin;
use App\Models\Mdl_Sales;
use App\Models\Mdl_Customer;
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

 public function checkMembership(Request $request)
    {
        $customer = Mdl_Customer::where('name', $request->name)
                                ->where('phone', $request->phone)
                                ->with('member') // Eager load the relationship
                                ->first();

        // --- ADD THIS DEBUGGING LINE ---
        \Log::info('Membership Check Request:', ['name' => $request->name, 'phone' => $request->phone]);
        \Log::info('Customer Found:', ['customer' => $customer ? $customer->toArray() : 'null']);
        if ($customer && $customer->member) {
            \Log::info('Member Data:', ['member' => $customer->member->toArray()]);
        }
        // --------------------------------

        if (!$customer || !$customer->member) {
            return response()->json(['status' => 'not_found']);
        }

        $member = $customer->member;

        return response()->json([
            'status' => 'found',
            'name' => $customer->name,
            'phone' => $customer->phone,
            'membership' => $member->type,
            'points' => $member->points
        ]);
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'orderNumber' => 'required|string',
            'total' => 'required|numeric|min:0',
            'paymentMethod' => 'required|string',
            'customerName' => 'nullable|string|max:255',
            'customerPhone' => 'nullable|string|max:20',
            'tableNumber' => 'nullable|integer',
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
            // 'items.*.note' => 'nullable|string', // if you want to save notes
        ]);

        try {
            DB::beginTransaction();

            $order = Mdl_Order::create([
                'order_number' => $request->orderNumber,
                'customer_name' => $request->customerName,
                'customer_phone' => $request->customerPhone,
                'table_number' => $request->tableNumber,
                'total_amount' => $request->total,
                'payment_method' => $request->paymentMethod, // Save the selected method
                'status' => 'completed', // Or 'pending', depending on your flow
            ]);

            foreach ($request->items as $itemData) {
                Mdl_OrderItem::create([
                    'order_id' => $order->id,
                    'item_name' => $itemData['name'],
                    'price' => $itemData['price'],
                    'quantity' => $itemData['quantity'],
                    // 'note' => $itemData['note'] ?? null, // if you send notes
                ]);

                // TODO: You might want to update inventory/stock here
                //Mdl_Product::where('name', $itemData['name'])->decrement('stock', $itemData['quantity']);
            }

            if ($request->customerPhone) {
                $customer = Mdl_Customer::where('phone', $request->customerPhone)->first();
                if ($customer && $customer->member) {
                    $pointsToAdd = floor($request->total / 10000); // 1 point for every 10,000 IDR
                    $customer->member->increment('points', $pointsToAdd); // Add points to existing
                }
            }


            switch ($request->paymentMethod) {
                case 'ShopeePay':
                case 'Qris':
                case 'Dana':
                    break;
                case 'Cash':
                    break;
                case 'Muamalat':
                case 'BRI':
                case 'BCA':
                    break;
                default:
                    break;
            }

            DB::commit();

            return response()->json(['message' => 'Pembayaran berhasil!', 'order_id' => $order->id]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack(); // Rollback on validation error
            return response()->json(['message' => 'Data tidak valid.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on any other error
            \Log::error('Payment processing error: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['message' => 'Terjadi kesalahan saat memproses pembayaran. Mohon coba lagi.', 'error' => $e->getMessage()], 500);
        }
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