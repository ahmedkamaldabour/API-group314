<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\FormRequest;

class UpdateProductRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:products,name,' . $this->id],
            'price' => ['required', 'numeric'],
        ];
    }

}
