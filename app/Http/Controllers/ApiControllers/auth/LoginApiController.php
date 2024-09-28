<?php

namespace App\Http\Controllers\ApiControllers\auth;

use App\Http\Controllers\WebControllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\Messages;
use Illuminate\Http\Request;

class LoginApiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = [
            'email' => request('email'),
            'password' => request('password')
        ];

        if (auth()->attempt($credentials)) {
            $data = auth()->user();

            $data['token'] = auth()->user()->createToken($data['email'])->plainTextToken;

            return Messages::success(UserResource::make($data), 'Login successfully');
        } else {
            return Messages::error('Login failed');
        }
    }
}
