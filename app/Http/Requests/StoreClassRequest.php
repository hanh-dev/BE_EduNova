<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRequest extends FormRequest
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
            'description' => 'nullable|string',
            'image' => 'nullable|file|image|max:2048',
            'teacherName' => 'required|exists:users,name',
            'students' => 'nullable|string',
            'students.*.name' => 'required_with:students|string|max:255',
            'students.*.email' => 'required_with:students|email|max:255',
            'students.*.password' => 'required_with:students|string|min:6',
        ];
    }
}
