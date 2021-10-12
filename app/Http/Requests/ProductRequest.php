<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255|unique:products',
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|max:1000',
            'stock' => 'required|numeric|max:9',
            'discount' => 'required|numeric|max:30',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ];
    }
}
