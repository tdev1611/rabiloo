<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
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
            'name' => [
                'required', 'string',
                Rule::unique('permissions')->ignore($this->route('permission'), 'id'),
            ],
            'guard_name' => [
                'required', 'string',
                Rule::unique('permissions')->ignore($this->route('permission'), 'id'),
            ],

        ];
        return $rule;
    }
}
