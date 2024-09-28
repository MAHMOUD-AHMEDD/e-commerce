<?php

namespace App\Http\Controllers\WebControllers;

use App\Models\Categories;
use App\Http\Controllers\WebControllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $categories=Categories::query()->get();
//        dd($categories);
        return view('welcome',compact('categories'));
    }
}
