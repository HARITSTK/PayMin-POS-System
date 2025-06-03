<?php

namespace App\Http\Controllers;

use App\Models\Mdl_Admin;
use Illuminate\View\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
        if ($user) {
            // Hapus photo kalau ada
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
            'name' => 'nuallable|string|max:255',
            'username' => 'nuallable|string|max:255',
            'role' => 'nuallable|in:admin,kasir',
            'password' => 'nullable|string|min:8',
        ]);

        $user = Mdl_Admin::CekId($id);

        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->role = $validatedData['role'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
    }


    public function setting() {
        return view('adminpage/setting');
    }
}