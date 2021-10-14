<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdate extends FormRequest
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
            //
            'name' => 'min:3|max:255|unique:products',
            'title' => 'min:3|max:255',
            'description' => 'min:3|max:255',
            'price' => 'numeric|max:1000',
            'stock' => 'numeric|max:9',
            'discount' => 'numeric|max:30',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    // return error message
    public function messages()
    {
        return [
            'name.min' => 'Product name must be at least 3 characters.',
            'name.max' => 'Product name cannot be longer than 255 characters.',
            'name.unique' => 'Product name already exists.',
            'title.min' => 'Product title must be at least 3 characters.',
            'title.max' => 'Product title cannot be longer than 255 characters.',
            'description.min' => 'Product description must be at least 3 characters.',
            'description.max' => 'Product description cannot be longer than 255 characters.',
            'price.numeric' => 'Product price must be a number.',
            'price.max' => 'Product price cannot be more than 1000.',
            'stock.numeric' => 'Product stock must be a number.',
            'stock.max' => 'Product stock cannot be more than 9.',
            'discount.numeric' => 'Product discount must be a number.',
            'discount.max' => 'Product discount cannot be more than 30.',
            'image.image' => 'Product image must be an image.',
            'image.mimes' => 'Product image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Product image cannot be larger than 2048 kilobytes.',
        ];
    }
}
