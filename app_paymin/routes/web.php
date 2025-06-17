<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Cassier;
use App\Http\Middleware\AuthMiddleware;

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

    Route::get('/HomeAdmin', [Admin::class, 'home'])->name('Home');
    Route::get('/ReportAdmin', [Admin::class, 'report'])->name('Report');
    Route::get('/ItemAdmin', [Admin::class, 'item'])->name('Item');
    Route::get('/MemberAdmin', [Admin::class, 'member'])->name('Member');
    Route::get('/MasterAdmin', [Admin::class, 'master'])->name('Master');
    Route::put('/SysAddMasterAdmin', [Admin::class, 'SysAddMaster'])->name('SysAddMaster');
    Route::put('/SysEditMasterAdmin/{id}', [Admin::class, 'SysEditMaster'])->name('SysEditMaster');
    Route::post('/delete-masterAdmin', [Admin::class, 'SysDeleteMaster'])->name('SysDeleteMaster');
    Route::get('/SettingAdmin', [Admin::class, 'setting'])->name('Setting');
    Route::put('/SysEditProfileAdmin', [Admin::class, 'SysEditProfile'])->name('SysEditProfile');
    Route::put('/SysUpdatePasswordAdmin', [Admin::class, 'SysUpdatePassword'])->name('SysUpdatePassword');
    
    Route::get('/HomeCassier', [Cassier::class, 'home'])->name('HomeCassier');
    Route::get('/OrderCassier', [Cassier::class, 'order'])->name('OrderCassier');
    Route::get('/ReportCassier', [Cassier::class, 'report'])->name('ReportCassier');
    Route::get('/ItemCassier', [Cassier::class, 'item'])->name('ItemCassier');
    Route::get('/MemberCassier', [Cassier::class, 'member'])->name('MemberCassier');
    Route::get('/SettingCassier', [Cassier::class, 'setting'])->name('SettingCassier');
    
});