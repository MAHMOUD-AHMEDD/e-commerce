<?php

namespace App\Http\Controllers\ApiControllers\auth;

use App\Http\Controllers\WebControllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use App\Services\Messages;
use Illuminate\Http\Request;

class RegisterApiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterFormRequest $request)
    {
        User::query()->create($request->validated());
        return Messages::success([], 'User created successfully');
    }
}
