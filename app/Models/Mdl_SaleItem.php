<?php

namespace App\Models;

// use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mdl_SaleItem extends Model
{
    protected $table = 'sale_items';
    protected $primaryKey = 'id';
    protected $fillable = ['sale_id', 'product_id', 'quantity', 'price', 'subtotal'];
    public $timestamps = true;

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Mdl_Sales::class, 'sale_id', 'id'); //
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Mdl_Product::class, 'product_id', 'id'); //
    }
}