<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSettingRequest extends FormRequest
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
            'key' => 'required|string|max:255|unique:settings',
            'value' => 'required|string',
            'group' => 'required|string|max:255',
            'type' => ['required', 'string', Rule::in(['text', 'textarea', 'number', 'boolean', 'select', 'email', 'url', 'tel', 'date'])],
            'label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'options' => 'nullable|array',
            'options.*' => 'required|string',
            'is_public' => 'nullable|boolean',
        ];
    }
}
