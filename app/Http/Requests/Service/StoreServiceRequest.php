<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'required|string',
            'order' => 'nullable|integer|min:0',
            'is_visible' => 'nullable|boolean',
        ];
    }
}
