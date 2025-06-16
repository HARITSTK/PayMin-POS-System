<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Karyawan;
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

    Route::get('/Home', [Admin::class, 'home'])->name('Home');
    Route::get('/Report', [Admin::class, 'report'])->name('Report');
    Route::get('/Item', [Admin::class, 'item'])->name('Item');
    Route::get('/Member', [Admin::class, 'member'])->name('Member');
    Route::get('/Master', [Admin::class, 'master'])->name('Master');
    Route::put('/SysAddMaster', [Admin::class, 'SysAddMaster'])->name('SysAddMaster');
    Route::put('/SysEditMaster/{id}', [Admin::class, 'SysEditMaster'])->name('SysEditMaster');
    Route::post('/delete-master', [Admin::class, 'SysDeleteMaster'])->name('SysDeleteMaster');
    Route::get('/Setting', [Admin::class, 'setting'])->name('Setting');
    Route::put('/SysEditProfile', [Admin::class, 'SysEditProfile'])->name('SysEditProfile');
    Route::put('/SysUpdatePassword', [Admin::class, 'SysUpdatePassword'])->name('SysUpdatePassword');
    
    Route::get('/HomeKaryawan', [Karyawan::class, 'home'])->name('HomeKaryawan');
    Route::get('/OrderKaryawan', [Karyawan::class, 'order'])->name('OrderKaryawan');
    Route::get('/ReportKaryawan', [Karyawan::class, 'report'])->name('ReportKaryawan');
    Route::get('/ItemKaryawan', [Karyawan::class, 'item'])->name('ItemKaryawan');
    Route::get('/MemberKaryawan', [Karyawan::class, 'member'])->name('MemberKaryawan');
    Route::get('/SettingKaryawan', [Karyawan::class, 'setting'])->name('SettingKaryawan');
    
});