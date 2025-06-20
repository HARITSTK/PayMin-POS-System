<?php

namespace App\Models;

// use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Mdl_Sales extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'customer_id', 'total', 'payment', 'change_amount', 'sale_date'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(Mdl_Admin::class, 'user_id');
    }
}