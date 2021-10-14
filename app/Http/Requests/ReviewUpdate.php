<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewUpdate extends FormRequest
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
            'customer' => 'string',
            'review' => 'string',
            'rating' => 'numeric|between:1,5'
        ];
    }

    // error messages
    public function messages()
    {
        return [
            'customer.string' => 'Customer name must be a string',
            'review.string' => 'Review must be a string',
            'rating.numeric' => 'Rating must be a number',
            'rating.between' => 'Rating must be between 1 and 5'
        ];
    }
}
