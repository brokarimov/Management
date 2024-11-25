<?php

namespace App\Http\Requests\Answer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'task_id' => 'required|exists:territory_tasks,id',
            'territory_id' => 'required|exists:territories,id',
            'title' => 'required|max:255',
            'file' => 'required|file|mimes:pdf',
        ];
    }
}
