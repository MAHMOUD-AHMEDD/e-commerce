<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|min:3|max:20|unique:users', //required | nullable | email
            'email' => 'required|email|min:3|max:150|unique:users',
            'password' => 'required|min:5',
            'type' => 'required',
            'address'=>'required|min:10',
            'image'=>'nullable|mimes:jpeg,jpg,png,svg,gif'
        ];
    }
}
