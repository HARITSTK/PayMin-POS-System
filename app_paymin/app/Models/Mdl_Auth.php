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
    protected $fillable = ['id', 'username', 'name', 'email', 'password', 'bio', 'role', 'is_active', 'created_at', 'updated_at'];
    public $timestamps = true;

    public static function checkadmin() {
        return self::where('role', 'admin')->where('is_active', 'y')->exists();
    }

    public static function CekUsername($username)
    {
        return self::where('username', $username)->first();
    }
     
    public static function adddatasetup($validatedData)
    {
        $count = self::count() + 1;
        $randomFive = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $id = $randomFive . $count;
        return self::create([
            'id' => $id,
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'admin',
            'is_active' => 'Y',
            'is_update' => date('Y-m-d H:i:s'),
            'is_create' => date('Y-m-d H:i:s')
        ]);
    }

}