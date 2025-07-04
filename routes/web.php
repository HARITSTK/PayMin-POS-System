<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Cassier;
use App\Http\Controllers\Storagee;
use App\Http\Controllers\Waiters;
use App\Http\Controllers\Kitchen;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('fpay');
});

Route::get('/Auth', [Auth::class, 'check'])->name('Auth');
Route::post('/SysSetup', [Auth::class, 'SysSetup'])->name('SysSetup');
Route::post('/SysLogin', [Auth::class, 'SysLogin'])->name('SysLogin');

Route::get('/Logout', function () {
    session()->flush();
    return redirect('/Auth')->with('message', 'Logout Successful.');
})->name('Logout');


Route::get('/exportCSVMaster', [Admin::class, 'exportCSVMaster'])->name('exportCSVMaster');
Route::get('/exportCSVMember', [Admin::class, 'exportCSVMember'])->name('exportCSVMember');
Route::get('/exportCSVReport', [Admin::class, 'exportCSVReport'])->name('exportCSVReport');


Route::middleware([AuthMiddleware::class])->group(function () {

    // ADMIN ROUTES
    Route::get('/HomeAdmin', [Admin::class, 'home'])->name('Home');
    Route::get('/ReportAdmin', [Admin::class, 'report'])->name('Report');
    Route::post('/transaction/delete', [Admin::class, 'delete'])->name('transaction.delete');
    Route::get('/ItemAdmin', [Admin::class, 'item'])->name('Item');
    Route::put('/SysAddItem', [Admin::class, 'SysAddItem'])->name('SysAddItem');
    Route::post('/SysEditItem', [Admin::class, 'SysEditItem'])->name('SysEditItem');
    Route::delete('/delete-item', [Admin::class, 'SysDeleteItem'])->name('SysDeleteItem');
    Route::get('/MemberAdmin', [Admin::class, 'member'])->name('Member');
    Route::post('/SysDeleteMember', [Admin::class, 'SysDeleteMember'])->name('SysDeleteMember');
    Route::get('/MasterAdmin', [Admin::class, 'master'])->name('Master');
    Route::post('/SysAddMasterAdmin', [Admin::class, 'SysAddMaster'])->name('SysAddMaster');
    Route::put('/SysEditMasterAdmin/{id}', [Admin::class, 'SysEditMaster'])->name('SysEditMaster');
    Route::post('/delete-masterAdmin', [Admin::class, 'SysDeleteMaster'])->name('SysDeleteMaster');
    Route::get('/SettingAdmin', [Admin::class, 'setting'])->name('Setting');
    Route::put('/SysEditProfileAdmin', [Admin::class, 'SysEditProfile'])->name('SysEditProfile');
    Route::put('/SysUpdatePasswordAdmin', [Admin::class, 'SysUpdatePassword'])->name('SysUpdatePassword');
    
    // CASSIER ROUTES
    Route::get('/HomeCassier', [Cassier::class, 'home'])->name('HomeCassier');
    Route::get('/OrderCassier', [Cassier::class, 'order'])->name('OrderCassier');
    Route::post('/check-membership', [Cassier::class, 'checkMembership']);
    Route::post('/membership/update', [Cassier::class, 'updateMembership']);
    // Route::post('/process-payment', [Cassier::class, 'processPayment']);
    // Route::post('/submit-sale', [Cassier::class, 'store']);
    Route::post('/submit-sale', function (Request $request) {
    return response()->json(['status' => 'received', 'data' => $request->all()]);
    });

    Route::get('/ReportCassier', [Cassier::class, 'report'])->name('ReportCassier');
    Route::get('/ItemCassier', [Cassier::class, 'item'])->name('ItemCassier');
    Route::get('/MemberCassier', [Cassier::class, 'member'])->name('MemberCassier');
    Route::get('/SettingCassier', [Cassier::class, 'setting'])->name('SettingCassier');

    // STORAGE ROUTES
    Route::get('/HomeStorage', [Storagee::class, 'home'])->name('HomeStorage');
    Route::get('/ItemStorage', [Storagee::class, 'item'])->name('ItemStorage');
    Route::get('/SettingStorage', [Storagee::class, 'setting'])->name('SettingStorage');
    // Route::put('/SysEditProfileStorage', [Storagee::class, 'SysEditProfile'])->name('SysEditProfileStorage');
    // Route::put('/SysUpdatePasswordStorage', [Storagee::class, 'SysUpdatePassword'])->name('SysUpdatePasswordStorage');

    // KITCHEN ROUTES
    Route::get('/HomeKitchen', [Kitchen::class, 'home'])->name('HomeKitchen');
    Route::get('/OrderKitchen', [Kitchen::class, 'order'])->name('OrderKitchen');
    Route::post('/SysOrderKitchenUpdate', [Kitchen::class, 'orderupdate'])->name('SysOrderKitchenUpdate');
    Route::get('/SettingKitchen', [Kitchen::class, 'setting'])->name('SettingKitchen');
    // Route::put('/SysEditProfileKitchen', [Kitchen::class, 'SysEditProfile'])->name('SysEditProfileKitchen');
    // Route::put('/SysUpdatePasswordKitchen', [Kitchen::class, 'SysUpdatePassword'])->name('SysUpdatePasswordKitchen');

    // WAITERS ROUTES
    Route::get('/HomeWaiters', [Waiters::class, 'home'])->name('HomeWaiters');
    Route::get('/OrderWaiters', [Waiters::class, 'order'])->name('OrderWaiters');
    Route::post('/SysOrderWaitersUpdate', [Waiters::class, 'orderupdate'])->name('SysOrderWaitersUpdate');
    Route::get('/SettingWaiters', [Waiters::class, 'setting'])->name('SettingWaiters');
    // Route::put('/SysEditProfileWaiters', [Waiters::class, 'SysEditProfile'])->name('SysEditProfileWaiters');
    // Route::put('/SysUpdatePasswordWaiters', [Waiters::class, 'SysUpdatePassword'])->name('SysUpdatePasswordWaiters');
    
});