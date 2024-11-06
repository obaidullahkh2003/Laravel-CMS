<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlockRequest extends FormRequest
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
            'region_id' => 'required|exists:block_regions,id',
            'content' => 'required|string',
            'is_active' => 'boolean',
            'title' => 'required|string|max:255',
            'img' => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'region_id.required' => 'The region ID is required.',
            'region_id.exists' => 'The selected region ID is invalid.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content must be a string.',
            'is_active.boolean' => 'The active status must be true or false.',
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'img.image' => 'The image must be a valid image file.',
            'img.max' => 'The image may not be greater than 2MB.',
        ];
    }
}
