<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Admin;

// Route::get('/', [Auth::class, 'Login'])->name('Login')->middleware('CekDataApp');

Route::get('/', function () {
    return view('fpay');
});

Route::get('/Auth', [Auth::class, 'check'])->name('Auth');
Route::post('/SysSetup', [Auth::class, 'SysSetup'])->name('SysSetup');
Route::post('/SysLogin', [Auth::class, 'SysLogin'])->name('SysLogin');

Route::get('/Logout', function () {
    session()->flush();
    return redirect('/Auth');
})->name('Logout');

Route::get('/Home', [Admin::class, 'home'])->name('Home');
Route::get('/Item', [Admin::class, 'item'])->name('Item');
Route::get('/Order', [Admin::class, 'order'])->name('Order');
Route::get('/Report', [Admin::class, 'report'])->name('Report');

Route::get('/Master', [Admin::class, 'master'])->name('Master');
Route::post('/SysAddMaster', [Admin::class, 'SysAddMaster'])->name('SysAddMaster');
Route::post('/delete-master', [Admin::class, 'SysDeleteMaster'])->name('SysDeleteMaster');

Route::get('/Setting', [Admin::class, 'setting'])->name('Setting');