<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TagRequest extends FormRequest
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
        $rule = [
            'title' => [
                'required', 'string',
                Rule::unique('tags')->ignore($this->route('tag'), 'id'),
            ],
            'slug' => [
                 'string',
                Rule::unique('tags')->ignore($this->route('tag'), 'id'),
            ],

        ];
        return $rule;

    }
    public function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }
}
