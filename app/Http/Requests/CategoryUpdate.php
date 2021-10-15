<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdate extends FormRequest
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
            'name' => 'min:3|max:255',
            'slug' => 'min:3|max:255|unique:categories',
            'parent_id' => 'nullable|min:1|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    // show error message
    public function messages()
    {
        return [
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be less than 255 characters.',
            'slug.min' => 'Slug must be at least 3 characters.',
            'slug.max' => 'Slug must be less than 255 characters.',
            'slug.unique' => 'Slug already exists.',
            'parent_id.min' => 'Parent ID must not be 0.',
            'parent_id.exists' => 'Parent ID must be exists.',
            'image.image' => 'Image must be an image.',
            'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Image must be less than 2048 kilobytes.',
        ];
    }
}
