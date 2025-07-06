<?php

namespace App\Models;

// use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mdl_Sales extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'customer_id', 'total', 'payment', 'change_amount', 'sale_date', 'status', 'table_no', 'note', 'type', 'quantity'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(Mdl_Admin::class, 'user_id');
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(Mdl_SaleItem::class, 'sale_id', 'id'); //
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Mdl_Payment::class, 'sale_id', 'id'); //
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Mdl_Customer::class, 'customer_id', 'id'); //
    }
}