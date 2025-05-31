<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Admin;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;

class Admin extends BaseController
{
    public function home() {
        return view('adminpage/home');
    }
 
    public function order() {
        return view('adminpage/order');
    }

    public function item() {
        return view('adminpage/items');
    }
 
    public function report() {
        return view('adminpage/orderhistory');
    }

    public function master() {
        $masterdata = Mdl_Admin::all();

        return view('adminpage/masterkey', compact('masterdata'));
    }

    public function setting() {
        return view('adminpage/setting');
    }
}