<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
class HomeController extends Controller
{
    public function index()
    {
        $categories=Categories::query()->get();
//        dd($categories);
        return view('welcome',compact('categories'));
    }
}
