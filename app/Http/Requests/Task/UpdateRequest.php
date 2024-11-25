<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'territory_id' => 'required|array',
            'territory_id.*' => 'exists:territories,id',
            'employee' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'required|file|mimes:pdf',
            'period' => 'required',
        ];
    }
}
