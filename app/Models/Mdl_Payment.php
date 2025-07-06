<?php

namespace App\Models;

// use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mdl_Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $fillable = ['sale_id', 'amount', 'payment_method', 'created_at'];
    public $timestamps = false;

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Mdl_Sales::class, 'sale_id', 'id'); //
    }
}