<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order_id' => 'required|exists:orders,id',
            'furniture_id' => 'required|exists:furnitures,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'nullable|numeric',
        ];
    }
}
