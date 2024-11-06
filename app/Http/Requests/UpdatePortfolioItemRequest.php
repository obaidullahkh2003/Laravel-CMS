<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePortfolioItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'client_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'subtitle.string' => 'The subtitle must be a string.',
            'subtitle.max' => 'The subtitle may not be greater than 255 characters.',
            'image_path.image' => 'The file must be an image.',
            'image_path.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image_path.max' => 'The image may not be greater than 2 MB.',
            'client_name.required' => 'The client is required.',
            'client_name.string' => 'The client must be a string.',
            'client_name.max' => 'The client may not be greater than 255 characters.',
            'category.required' => 'The category is required.',
            'category.string' => 'The category must be a string.',
            'category.max' => 'The category may not be greater than 255 characters.',
        ];
    }
}
