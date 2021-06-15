<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string|email|regex:/^\S*$/u',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'this field is Required',
            'regex' => 'White Space not allowed',
        ];
    }
}
