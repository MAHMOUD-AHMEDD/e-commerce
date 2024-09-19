<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
class Orders extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'product_id',
        'price',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class,'product_id');
    }
}
