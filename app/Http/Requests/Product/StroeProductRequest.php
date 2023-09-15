<?php

namespace App\Http\Requests\Product;



use App\Http\Requests\FormRequest;

class StroeProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:products,name'],
            'price' => ['required', 'numeric'],
        ];
    }
}
