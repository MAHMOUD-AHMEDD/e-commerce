<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\services\reviews\SaveReviewsService;
class ReviewsController extends Controller
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
