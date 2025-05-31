<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Auth;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Auth extends BaseController
{
    public function check()
    {
        $check = Mdl_Auth::checkadmin();
        if (empty($check)) {
            return $this->setuppay();
        } else {
            return $this->loginpay();
        }
    }
    
    public function setuppay() {
        return view('authpage/setuppay');
    }

    public function SysSetup(Request $request) {
        $input = $request->all();
        // $input['username'] = trim($input['username']);
        // $input['name'] = trim($input['name']);
        $input['password'] = trim($input['password']);

        $validatedData = Validator::make($input, [
            'username' => 'required|min:5',
            'name' => 'required|min:5',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username harus diisi!',
            'username.min' => 'Username harus memiliki minimal 5 karakter!',
            'name.required' => 'Nama harus diisi!',
            'name.min' => 'Nama harus memiliki minimal 5 karakter!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password harus memiliki minimal 8 karakter!',
        ])->validate();

        Mdl_Auth::adddata($validatedData);

        return redirect()->route('Auth')->with('message', 'Set up berhasil dibuat, silahkan login dengan akun yang dibuat');
    }
    
    public function loginpay() {
        return view('authpage/loginpay');
    }

    public function SysLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi!',
            'password.required' => 'Password harus diisi!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $username = $request->input('username');
        $password = trim($request->input('password'));

        $user = Mdl_Auth::CekUsername($username);

        if (!$user) {
            return back()->withErrors(['username' => 'Akun tidak ditemukan!'])->withInput();
        }

        if (!password_verify($password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah!'])->withInput();
        }

        if ($user->role == 'admin') {
            session([
                'user_id' => $user->id,
                'username_admin' => $user->username_user,
                'nama_admin' => $user->nama_user,
                'role_admin' => $user->role,
            ]);
            return redirect()->route('Home');
        } elseif ($user->role == 'kasir') {
            // session([
            //     'user_id' => $user->id,
            //     'username_kasir' => $user->username_user,
            //     'nama_kasir' => $user->nama_user,
            //     'role_kasir' => $user->role,
            // ]);
            // return redirect()->route('Dashboardkasir');
        } else {
            return back()->withErrors(['username' => 'Akun tidak memiliki role!'])->withInput();
        }
    }

}