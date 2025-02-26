<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'slug' => 'nullable|string|max:255|unique:products',
            'description' => 'required|string',
            'image' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'required|string',
            'status' => ['required', Rule::in(['draft', 'coming_soon', 'published'])],
            'launch_date' => 'nullable|date',
            'teaser_content' => 'nullable|string',
            'is_visible' => 'nullable|boolean',
            'order' => 'nullable|integer|min:0',
        ];
    }
}
