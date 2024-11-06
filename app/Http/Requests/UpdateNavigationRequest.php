<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNavigationRequest extends FormRequest
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
            'label' => 'sometimes|required|string|max:255',
            'url' => 'sometimes|required|string',
            'order' => 'sometimes|required|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'label.required' => 'The label field is required.',
            'label.string' => 'The label must be a string.',
            'label.max' => 'The label may not be greater than 255 characters.',

            'url.required' => 'The URL field is required.',
            'url.string' => 'The URL must be a valid URL.',

            'order.required' => 'The order field is required.',
            'order.integer' => 'The order must be an integer.',
            'order.min' => 'The order must be at least 0.',

            'is_active.boolean' => 'The is active field must be true or false.',
        ];
    }
}
