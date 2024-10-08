<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|min:2|unique:posts,title,'.$this->route('post')->id,
            'description' => 'required|min:20',
            'excerpt' => 'required|min:10',
            'category' => 'required|exists:categories,id',
            'featured-image' => 'nullable|mimes:jpeg,jpg,png|file|max:5120',
            "photos.*" => "nullable|mimes:jpeg,png,jpg|file|max:5120",
        ];
    }
}
