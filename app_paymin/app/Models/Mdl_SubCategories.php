<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Mdl_SubCategories extends Model
{
    protected $table = 'subcategories';
    protected $primaryKey = 'id';
    protected $fillable = ['category_id', 'name', 'created_at', 'updated_at'];
    public $timestamps = true;

}