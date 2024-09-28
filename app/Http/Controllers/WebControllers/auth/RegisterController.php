<?php

namespace App\Http\Controllers\WebControllers\auth;

use App\actions\ImageModelSave;
use App\Http\Controllers\WebControllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\services\users\SaveUserInfoService;
use App\traits\upload_image;

class RegisterController extends Controller
{
    use upload_image;
    public function index()
    {
        return view('auth.register');
    }
    public function save(RegisterFormRequest $request)
    {
        $userData=$request->validated();
        $file = request()->file('image');
        if ($file == null){
            $image_name = 'default.png';
        }else{
            $image_name= $this->uploadImage($file,'users');
        }
        $user=SaveUserInfoService::save($userData);
        ImageModelSave::make($user->id,'User',$image_name);
//        dd(request()->all());
        return redirect()->back()->with('success','You registered successfully!');


    }

}
