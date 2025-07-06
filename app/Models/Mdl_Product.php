<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mdl_Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'category_id' , 'subcategory_id', 'price', 'stock', 'desc', 'image', 'created_at', 'updated_at'];
    public $timestamps = false;
    
    public function category()
    {
        return $this->belongsTo(Mdl_Categories::class, 'category_id');
    }

    public function saleItems()
    {
        return $this->hasMany(Mdl_SaleItem::class, 'product_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Mdl_Subcategory::class);
    }

}