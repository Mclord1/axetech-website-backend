<?php

namespace App\Http\Requests\Project;

use App\Traits\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProjectRequest extends FormRequest
{
    use ValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'key_features' => $this->key_features ?? null,
            'challenge' => $this->challenge ?? null,
            'solution' => $this->solution ?? null,
            'results' => $this->results ?? null,
            'main_image_links' => $this->main_image_links ?? null,
            'is_visible' => $this->is_visible ?? null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => self::RULE_OPTIONAL_STRING_MAX_255,
            'overview' => self::RULE_OPTIONAL_STRING,
            'key_features' => self::RULE_OPTIONAL_STRING,
            'challenge' => self::RULE_OPTIONAL_STRING,
            'solution' => self::RULE_OPTIONAL_STRING,
            'results' => self::RULE_OPTIONAL_STRING,
            'main_image_links' => self::RULE_OPTIONAL_STRING,
            'is_visible' => self::RULE_OPTIONAL_BOOLEAN
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'code' => 422,
                'message' => 'Validation failed',
                'errors' => collect($validator->errors())->map(function ($messages, $field) {
                    return ['field' => $field, 'message' => $messages[0]];
                })->values()->toArray(),
                'meta' => []
            ], 422)
        );
    }
}
