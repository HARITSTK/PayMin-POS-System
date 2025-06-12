<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Mdl_Member extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'name', 'email', 'password', 'bio', 'role', 'photo', 'is_active', 'created_at', 'updated_at'];
    public $timestamps = true;
}