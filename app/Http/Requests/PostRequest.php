<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
                'required', 'string', 'max:250',
                Rule::unique('posts')->ignore($this->route('post'), 'id'),
            ],
            'slug' => [
                'required', 'string', 'max:250',
                Rule::unique('posts')->ignore($this->route('post'), 'id'),
            ],
            'published_at' => 'nullable|date',
            'desc' => 'required|string',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:5000',
            'category_id' => 'required|exists:categories,id',
        ];
        return $rule;
    }
}
