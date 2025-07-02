<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mdl_Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_id', 'type', 'last_type', 'amount', 'points', 'created_at', 'updated_at'];
    public $timestamps = true;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Mdl_Customer::class, 'customer_id', 'id');
    }

}