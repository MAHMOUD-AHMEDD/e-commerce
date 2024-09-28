<?php

namespace App\Models;

use App\Models\Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categories;
use App\Models\Reviews;
use App\Models\Orders;
class Products extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable=[
        'name',
        'info',
        'price',
        'supplier_id',
    ];
    public function images()
    {
        return $this->morphMany(Images::class,'imageable');
    }
    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'product_categories', 'product_id', 'category_id');
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'product_id')->with('user');
    }
    public function orders()
    {
        return $this->hasMany(Orders::class,'product_id');
    }
    public function FavoriteByUsers()
    {
        return $this->belongsToMany(User::class,'favorite_products','product_id','user_id');
    }
}
