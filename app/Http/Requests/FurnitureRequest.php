<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FurnitureRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image',
            'stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ];
    }
}
