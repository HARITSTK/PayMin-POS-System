<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Auth;
use App\Models\Mdl_Admin;
use App\Models\Mdl_Sales;
use App\Models\Mdl_Customer;
use App\Models\Mdl_Member;
use App\Models\Mdl_Payment;
use App\Models\Mdl_Product;
use App\Models\Mdl_SaleItem;
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

    public function updateMembership(Request $request)
    {
        $customer = Mdl_Customer::where('name', $request->input('name'))
            ->where('phone', $request->input('phone'))
            ->with('member')
            ->first();

        if (!$customer || !$customer->member) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'Customer not found or no membership.'
            ], 404);
        }

        $member = $customer->member;

        if ($member->type === 'Expired' && $member->last_type) {
            $member->type = $member->last_type;
            $member->last_type = null;
            $member->save();

            return response()->json([
                'status' => 'updated',
                'cost' => 20000
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Membership is still active or cannot be updated.'
        ], 400);
    }



    // public function processPayment(Request $request)
    // {
    //     $request->validate([
    //         // ... (existing validations)
    //         'cash_received' => 'nullable|numeric|min:0', // New: for cash payments
    //         'change_amount' => 'nullable|numeric', // New: for cash payments
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         $customer = null;
    //         $customerId = null;
    //         if ($request->customerPhone) {
    //             $customer = Customer::firstOrCreate(
    //                 ['phone' => $request->customerPhone],
    //                 ['name' => $request->customerName ?? 'Guest', 'address' => null]
    //             );
    //             $customerId = $customer->id;
    //         }

    //         $sale = Sale::create([
    //             'user_id' => auth()->id(),
    //             'customer_id' => $customerId,
    //             'total' => $request->total,
    //             'change_amount' => $request->change_amount ?? 0.00, // Use the value from frontend
    //             'sale_date' => Carbon::now(),
    //             'type' => $request->sale_type,
    //             'quantity' => array_sum(array_column($request->items, 'quantity')),
    //             'tax_amount' => $request->tax_amount,
    //             'discount_amount' => $request->discount_amount,
    //         ]);

    //         foreach ($request->items as $itemData) {
    //             SaleItem::create([
    //                 'sale_id' => $sale->id,
    //                 'product_id' => $itemData['product_id'],
    //                 'quantity' => $itemData['quantity'],
    //                 'price' => $itemData['price'],
    //                 'subtotal' => $itemData['price'] * $itemData['quantity'],
    //             ]);
    //             // TODO: Product stock decrement
    //             Product::where('id', $itemData['product_id'])->decrement('stock', $itemData['quantity']);
    //         }

    //         $paymentMethodInDB = $this->mapPaymentMethodForDB($request->paymentMethod);
    //         Payment::create([
    //             'sale_id' => $sale->id,
    //             'payment_method' => $paymentMethodInDB,
    //             'amount' => $request->total, // Amount recorded in payments table is the total bill
    //         ]);

    //         if ($customer && $customer->member && $request->customer_membership && $request->customer_membership !== 'not_found') {
    //             $pointsToAdd = floor($request->total / 10000);
    //             $customer->member->increment('points', $pointsToAdd);
    //         }

    //         DB::commit();

    //         return response()->json([
    //             'message' => 'Pembayaran berhasil!',
    //             'order_number' => $sale->order_number,
    //             'total_paid' => $sale->total,
    //             'payment_method' => $request->paymentMethod,
    //             'subtotal_before_discount' => $request->subtotal_before_discount,
    //             'tax_amount' => $request->tax_amount,
    //             'discount_amount' => $request->discount_amount,
    //             'customer_membership' => $request->customer_membership,
    //             'items' => $request->items,
    //             'cash_received' => $request->cash_received, // Return these for display
    //             'change_amount' => $request->change_amount, // Return these for display
    //         ], 200);

    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         DB::rollBack();
    //         return response()->json(['message' => 'Data tidak valid.', 'errors' => $e->errors()], 422);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         \Log::error('Payment processing error: ' . $e->getMessage(), ['exception' => $e->getTraceAsString(), 'request' => $request->all()]);
    //         return response()->json(['message' => 'Terjadi kesalahan saat memproses pembayaran. Mohon coba lagi.', 'error' => $e->getMessage()], 500);
    //     }
    // }

    // private function mapPaymentMethodForDB(string $frontendMethod): string
    // {
    //     // Based on your payment_method ENUM ('cash','card','ewallet')
    //     switch ($frontendMethod) {
    //         case 'Cash': return 'cash';
    //         case 'ShopeePay':
    //         case 'Qris':
    //         case 'Dana': return 'ewallet';
    //         case 'Muamalat':
    //         case 'BRI':
    //         case 'BCA': return 'card';
    //         default: return 'ewallet'; // Default to ewallet or handle error
    //     }
    // }


    // private function getProductIdFromName(string $productName): ?int
    // {
    //     $product = Product::where('name', $productName)->first();
    //     return $product ? $product->id : null;
    // }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $customer = Mdl_Customer::firstOrCreate(
                ['name' => $request->customer_name, 'phone' => $request->customer_phone]
            );

            $userId = session('user_id');

            // Buat sales
            
            $sale = Mdl_Sales::create([
                'user_id' => $userId,
                'customer_id' => $customer->id,
                'total' => $request->total,
                'change_amount' => $request->change_amount,
                'type' => $request->dine_type,
                'quantity' => collect($request->orders)->sum('quantity'),
                'table_no' => $request->table,
                'note' => $request->note,
                'status' => 'procced'
            ]);

            // Simpan item
            foreach ($request->orders as $item) {
                Mdl_SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            // Simpan pembayaran
            Mdl_Payment::create([
                'sale_id' => $sale->id,
                'payment_method' => $request->payment_method,
                'amount' => $request->payment_amount
            ]);

            DB::commit();

            if ($request->total >= 100000) {
                // Cek apakah customer sudah punya membership
                $existingMember = Mdl_Member::where('customer_id', $customer->id)->first();

              if ($existingMember) {
                $existingMember->update([
                    'points' => $existingMember->points + 5,
                    'amount' => $existingMember->amount + $request->total,
                ]);
                } else {
                    Mdl_Member::create([
                        'customer_id' => $customer->id,
                        'type' => 'Silver',
                        'points' => 5,
                        'amount' => $request->total,
                    ]);
                }
            }

            return response()->json(['status' => 'success', 'sale_id' => $sale->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }




    // REPORT
    public function report() {
        $userId = session('user_id'); // atau auth()->id()

        $sales = Mdl_Sales::with(['user', 'customer', 'payments'])->where('user_id', $userId)->get();

        $beginningBalance = DB::table('balances')->sum('beginning_balance');
        $TotalIncome = DB::table('sales')
            ->where('user_id', $userId)
            ->sum('total');       
        $moneyOut = DB::table('payments')->sum('return');

        return view('cassierpage/report', compact('sales', 'beginningBalance','TotalIncome', 'moneyOut'));
    }

    public function exportCSVreport()
    {
        $userId = session('user_id');
        $fileName = 'Report_Data_' . now()->format('Ymd_His') . '.csv';
        $sales = Mdl_Sales::with(['user', 'customer', 'payments'])->where('user_id', $userId)->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['id', 'Cassa Name', 'Date', 'Name Customer', 'item', 'payment method', 'type order', 'amount'];

        $callback = function () use ($sales, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($sales as $s) {
                fputcsv($file, [
                    $s->id,
                    optional($s->user)->name,
                    optional($s->sale_date)->format('Y-m-d H:i:s') ?? '-',
                    optional($s->customer)->name,
                    implode(', ', $s->saleItems->map(fn($item) => optional($item->product)->name)->toArray()),
                    optional($s->payment)->payment_method,
                    $s->type,
                    $s->quantity,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
        $products = Mdl_Product::with('category')->get();

        return view('cassierpage/items',compact('outOfStock', 'lowStock', 'totalProducts', 'categories', 'products'));
    }

    // MEMBERSHIP
    public function member()
    {
        $members = Mdl_Member::with('customer')->get();
        return view('cassierpage/member', compact('members'));
    }

    public function exportCSVMember()
    {
        $fileName = 'Membership_Data_' . now()->format('Ymd_His') . '.csv';
        $member = Mdl_Member::with(['customer'])->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Member id', 'Name', 'Date', 'Amount', 'Point', 'No Telp', 'Type'];

        $callback = function () use ($member, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($member as $m) {
                fputcsv($file, [
                    $m->id,
                    optional($m->customer)->name ?? '-',
                    optional($m->updated_at)->format('Y-m-d H:i:s') ?? '-',
                    $m->amount,
                    $m->points,
                    optional($m->customer)->phone ?? '-',
                    $m->type,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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