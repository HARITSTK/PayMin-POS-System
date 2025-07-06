<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mdl_Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'phone', 'address', 'created_at'];
    public $timestamps = false;

    public function member() : HasOne
    {
        return $this->hasOne(Mdl_Member::class, 'customer_id', 'id');
    }

}