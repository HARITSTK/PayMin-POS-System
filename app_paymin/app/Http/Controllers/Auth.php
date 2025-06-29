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

        Mdl_Auth::adddatasetup($validatedData);

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
                'username_admin' => $user->username,
                'name_admin' => $user->name,
                'email_admin' => $user->email,
                'photo_admin' => $user->photo,
                'role_admin' => $user->role,
                'bio_admin' => $user->bio,
            ]);
            return redirect()->route('Home');

        } elseif ($user->role == 'cassier') {
            session([
                'user_id' => $user->id,
                'username_cassier' => $user->username,
                'name_cassier' => $user->name,
                'email_cassier' => $user->email,
                'photo_cassier' => $user->photo,
                'role_cassier' => $user->role,
                'bio_cassier' => $user->bio,
            ]);
            return redirect()->route('HomeCassier');
            
        } elseif ($user->role == 'kitchen') {
            session([
                'user_id' => $user->id,
                'username_kitchen' => $user->username,
                'name_kitchen' => $user->name,
                'role_kitchen' => $user->role,
                'bio_kitchen' => $user->bio,
            ]);
            return redirect()->route('HomeKitchen');
        } elseif ($user->role == 'storage') {
            session([
                'user_id' => $user->id,
                'username_storage' => $user->username,
                'name_storage' => $user->name,
                'role_storage' => $user->role,
                'bio_storage' => $user->bio,
            ]);
            return redirect()->route('HomeStorage');
        } elseif ($user->role == 'waiters') {
            session([
                'user_id' => $user->id,
                'username_waiters' => $user->username,
                'name_waiters' => $user->name,
                'role_waiters' => $user->role,
                'bio_waiters' => $user->bio,
            ]);
            return redirect()->route('HomeWaiters');
        } else {
            return back()->withErrors(['username' => 'Akun tidak memiliki role!'])->withInput();
        }
    }

}