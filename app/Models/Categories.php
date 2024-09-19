<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
class Categories extends Model
{
    use HasFactory;
    protected $fillable=[
      'name'
    ];
    public function products(){
        return $this->belongsToMany(Products::class,'product_categories','category_id','product_id');
    }
}
