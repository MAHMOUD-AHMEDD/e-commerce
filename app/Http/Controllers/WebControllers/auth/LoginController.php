<?php

namespace App\Http\Controllers\WebControllers\auth;

use App\Http\Controllers\WebControllers\Controller;
use App\Http\Requests\LoginFormRequest;
//use App\Http\Controllers\WebControllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function save(LoginFormRequest $request)
    {
        $data=$request->validated();
     if(auth()->attempt($data)){
         $user=auth()->user();
         if($user->type=='admin'){
             return redirect()->to('dashboard/users');
         }
         else{
//             dd($data);
             return redirect()->to('/');
         }
     }
     else{
         return redirect()->back()->withErrors(['error' => 'Email or password invalid']);
     }
//        return view('auth.login');
    }

}
