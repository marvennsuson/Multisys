<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function rules()
    {
        
        return [
            'name' => 'required|string',
            'quantity' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'this field is Required',
        ];
    }
}
