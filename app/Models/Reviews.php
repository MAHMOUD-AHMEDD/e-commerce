<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Products;

class Reviews extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'product_id',
        'rating',
        'comment',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
