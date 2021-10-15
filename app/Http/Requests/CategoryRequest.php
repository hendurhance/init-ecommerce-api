<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:categories',
            'parent_id' => 'nullable|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    // error messages
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
            'name.max' => 'Name must be less than 255 characters',
            'slug.required' => 'Slug is required',
            'slug.min' => 'Slug must be at least 3 characters',
            'slug.max' => 'Slug must be less than 255 characters',
            'slug.unique' => 'Slug must be unique',
            'parent_id.numeric' => 'Parent id must be numeric',
            'parent_id.min' => 'Parent id must be 0',
            'image.required' => 'Image is required',
            'image.image' => 'Image must be an image',
            'image.mimes' => 'Image must be a jpeg, png, jpg, gif, or svg',
            'image.max' => 'Image must be less than 2048 kilobytes',
        ];
    }
}
