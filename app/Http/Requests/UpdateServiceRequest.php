<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|image',
            'is_active' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
            'icon.required' => 'The icon is required.',
            'icon.image' => 'The icon must be a img.',
            'is_active.boolean' => 'The is_active field must be true or false.',
        ];
    }
}

