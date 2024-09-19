<?php

namespace App\services\reviews;
use App\Models\Products;
use App\Models\Reviews;
class SaveReviewsService
{
    public static function make($product_id,$rating,$comment)
    {
        Reviews::query()->create([
            'user_id'=>auth()->id(),
           'product_id'=>$product_id,
           'rating'=>$rating,
           'comment'=>$comment,
        ]);
    }
}
