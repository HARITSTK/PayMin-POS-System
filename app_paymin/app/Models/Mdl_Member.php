<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Mdl_Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_id', 'membership_date', 'membership_type', 'amount', 'points', 'created_at', 'updated_at'];
    public $timestamps = true;
}