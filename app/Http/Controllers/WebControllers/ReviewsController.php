<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\WebControllers;
use App\services\reviews\SaveReviewsService;
use Illuminate\Http\Request;
use App\Http\Controllers\WebControllers\Controller;

class ReviewsController extends WebControllers\Controller
{
    public function index()
    {

    }
    public function add(Request $request , $product_id)
    {
        SaveReviewsService::make($product_id,$request->input('rating'),$request->input('comment'));
        return redirect()->back()->with('success','Your review has been added to the product');
    }

}
