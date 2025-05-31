<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Mdl_Auth extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'name', 'email', 'password', 'bio', 'role', 'is_active', 'created_at', 'updated_at'];
    public $timestamps = false;

    public static function checkadmin() {
        return self::where('id', 1)->where('is_active', 1)->exists();
    }

    public static function CekUsername($username)
    {
        return self::where('username', $username)->first();
    }
     
    public static function adddata($validatedData)
    {
        return self::create([
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']),
            'id_role' => 1,
            'is_active' => 'Y',
            'is_update' => date('Y-m-d H:i:s'),
            'is_create' => date('Y-m-d H:i:s')
        ]);
    }

}