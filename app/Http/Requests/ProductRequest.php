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

    // if validation fails return the error message
    public function messages()
    {
        return [
            'name.required' => 'Product name is required',
            'name.max' => 'Product name must be less than 255 characters',
            'name.unique' => 'Product name already exists',
            'title.required' => 'Product title is required',
            'title.max' => 'Product title must be less than 255 characters',
            'description.required' => 'Product description is required',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Product price must be numeric',
            'price.max' => 'Product price must be less than 1000',
            'stock.required' => 'Product stock is required',
            'stock.numeric' => 'Product stock must be numeric',
            'stock.max' => 'Product stock must be less than 9',
            'discount.required' => 'Product discount is required',
            'discount.numeric' => 'Product discount must be numeric',
            'discount.max' => 'Product discount must be less than 30',
            'image.required' => 'Product image is required',
            'image.image' => 'Product image must be an image',
            'image.mimes' => 'Product image must be a file of type: jpeg,png,jpg,gif,svg',
            'image.max' => 'Product image must be less than 2048 kilobytes',
        ];
    }


}
