<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'name' => 'required|string',
            'password' => 'required|string|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'this field is Required',
        ];
    }
}
