<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequest_Products extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|string|unique:products',
            'quantity' => 'required|',
            'price' => 'required|',
            'voucher' => 'required|',
            'description' => 'required|string',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:2048'
        ];
    }
}
