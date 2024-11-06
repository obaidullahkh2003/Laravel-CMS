<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarouselRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image_url' => 'sometimes|required|url',
            'subheading' => 'sometimes|required|string|max:255',
            'heading' => 'sometimes|required|string|max:255',
            'button_text' => 'sometimes|required|string|max:255',
            'button_link' => 'sometimes|required|string',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'image_url.required' => 'The image URL is required.',
            'image_url.url' => 'The image URL must be a valid URL.',
            'subheading.required' => 'The subheading is required.',
            'subheading.string' => 'The subheading must be a string.',
            'subheading.max' => 'The subheading may not be greater than 255 characters.',
            'heading.required' => 'The heading is required.',
            'heading.string' => 'The heading must be a string.',
            'heading.max' => 'The heading may not be greater than 255 characters.',
            'button_text.required' => 'The button text is required.',
            'button_text.string' => 'The button text must be a string.',
            'button_text.max' => 'The button text may not be greater than 255 characters.',
            'button_link.required' => 'The button link is required.',
            'button_link.url' => 'The button link must be a valid URL.',
            'is_active.boolean' => 'The active status must be true or false.',
        ];
    }
}
