<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Admin;
use App\Models\Mdl_Member;
use App\Models\Mdl_Sales;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Admin extends BaseController
{
    // DASHBOARD / HOME
    public function home() {
        $userId = session('user_id');
        $user = Mdl_Admin::where('id', $userId)->first();

        $today = Carbon::today();

        $admissionFee = DB::table('payments')
            ->whereDate('created_at', $today)
            ->sum('amount');
        
        return view('adminpage/home',  compact('user', 'admissionFee'));
    }

    // ITEM
    public function item() {
        return view('adminpage/items');
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

        return view('adminpage/report', compact('user', 'sales', 'beginningBalance', 'admissionFee', 'moneyOut'));
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
        $validatedData = $request->validate([
            'role' => 'required',
            'username' => 'required|min:5',
            'name' => 'required|min:5',
            'password' => 'required|min:8',
            'photo' => 'nullable|image|mimes:png|max:2048',
        ], [
            'role.required' => 'role harus diisi!',
            'username.required' => 'Username harus diisi!',
            'username.min' => 'Username harus memiliki minimal 5 karakter!',
            'name.required' => 'Nama harus diisi!',
            'name.min' => 'Nama harus memiliki minimal 5 karakter!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password harus memiliki minimal 8 karakter!',
            'photo.image' => 'File harus berupa gambar!',
            'photo.mimes' => 'Hanya gambar PNG yang diperbolehkan!',
            'photo.max' => 'Ukuran maksimal 2MB!',
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