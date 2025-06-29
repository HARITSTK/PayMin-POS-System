<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Auth;
use App\Models\Mdl_Admin;
use App\Models\Mdl_Sales;
use App\Models\Mdl_Customer;
use App\Models\Mdl_Member;
use App\Models\Mdl_Product;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        $ordersToday = Mdl_Sales::with(['saleItems.product'])
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
            // ... (existing validations)
            'cash_received' => 'nullable|numeric|min:0', // New: for cash payments
            'change_amount' => 'nullable|numeric', // New: for cash payments
        ]);

        try {
            DB::beginTransaction();

            $customer = null;
            $customerId = null;
            if ($request->customerPhone) {
                $customer = Customer::firstOrCreate(
                    ['phone' => $request->customerPhone],
                    ['name' => $request->customerName ?? 'Guest', 'address' => null]
                );
                $customerId = $customer->id;
            }

            $sale = Sale::create([
                'user_id' => auth()->id(),
                'customer_id' => $customerId,
                'total' => $request->total,
                'change_amount' => $request->change_amount ?? 0.00, // Use the value from frontend
                'sale_date' => Carbon::now(),
                'type' => $request->sale_type,
                'quantity' => array_sum(array_column($request->items, 'quantity')),
                'tax_amount' => $request->tax_amount,
                'discount_amount' => $request->discount_amount,
            ]);

            foreach ($request->items as $itemData) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $itemData['product_id'],
                    'quantity' => $itemData['quantity'],
                    'price' => $itemData['price'],
                    'subtotal' => $itemData['price'] * $itemData['quantity'],
                ]);
                // TODO: Product stock decrement
                Product::where('id', $itemData['product_id'])->decrement('stock', $itemData['quantity']);
            }

            $paymentMethodInDB = $this->mapPaymentMethodForDB($request->paymentMethod);
            Payment::create([
                'sale_id' => $sale->id,
                'payment_method' => $paymentMethodInDB,
                'amount' => $request->total, // Amount recorded in payments table is the total bill
            ]);

            if ($customer && $customer->member && $request->customer_membership && $request->customer_membership !== 'not_found') {
                $pointsToAdd = floor($request->total / 10000);
                $customer->member->increment('points', $pointsToAdd);
            }

            DB::commit();

            return response()->json([
                'message' => 'Pembayaran berhasil!',
                'order_number' => $sale->order_number,
                'total_paid' => $sale->total,
                'payment_method' => $request->paymentMethod,
                'subtotal_before_discount' => $request->subtotal_before_discount,
                'tax_amount' => $request->tax_amount,
                'discount_amount' => $request->discount_amount,
                'customer_membership' => $request->customer_membership,
                'items' => $request->items,
                'cash_received' => $request->cash_received, // Return these for display
                'change_amount' => $request->change_amount, // Return these for display
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json(['message' => 'Data tidak valid.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Payment processing error: ' . $e->getMessage(), ['exception' => $e->getTraceAsString(), 'request' => $request->all()]);
            return response()->json(['message' => 'Terjadi kesalahan saat memproses pembayaran. Mohon coba lagi.', 'error' => $e->getMessage()], 500);
        }
    }

    private function mapPaymentMethodForDB(string $frontendMethod): string
    {
        // Based on your payment_method ENUM ('cash','card','ewallet')
        switch ($frontendMethod) {
            case 'Cash': return 'cash';
            case 'ShopeePay':
            case 'Qris':
            case 'Dana': return 'ewallet';
            case 'Muamalat':
            case 'BRI':
            case 'BCA': return 'card';
            default: return 'ewallet'; // Default to ewallet or handle error
        }
    }


    private function getProductIdFromName(string $productName): ?int
    {
        $product = Product::where('name', $productName)->first();
        return $product ? $product->id : null;
    }



    // REPORT
    public function report() {
        $userId = session('user_id'); // atau auth()->id()

        $user = Mdl_Admin::all();
        $sales = Mdl_Sales::with(['user', 'customer', 'payments'])->where('user_id', $userId)->get();

        // $today = Carbon::today();

        // $beginningBalance = DB::table('balances')->whereDate('date', $today)->value('beginning_balance') ?? 0;
        $TotalIncome = DB::table('sales')
            ->where('user_id', $userId)
            ->sum('total');        $TotalItemSell = DB::table('sale_items')->where('product_id')->count();
            $admissionFee = DB::table('payments')->sum('amount');

        return view('cassierpage/report', compact('user', 'sales', 'TotalIncome', 'admissionFee'));
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

        return view('cassierpage/items',compact('outOfStock', 'lowStock', 'totalProducts', 'categories', 'products'));
    }

    // MEMBERSHIP
    public function member()
    {
        $members = Mdl_Member::with('customer')->get();
        return view('cassierpage/member', compact('members'));
    }


    // SETTINGS
    public function setting()
    {
        $userId = session('user_id');
        $user = Mdl_Admin::where('id', $userId)->first();
        
        return view('cassierpage/setting', compact('user'));
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
}