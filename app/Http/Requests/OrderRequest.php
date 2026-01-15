<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string',
            'customer_phone_number' => 'required|string|max:20',
            'total_price' => 'required|numeric',
            'status' => 'nullable|string',
        ];
    }
}
