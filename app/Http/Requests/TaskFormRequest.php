<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable','string', 'max:512'],
            'status' => ['required', 'string', 'max:255'],
            'assigned_to_id' => ['required', 'integer', 'exists:users,id'],
            'labels' => ['array'],
            'labels.*' => ['nullable', 'string', 'max:255']
        ];
    }
}
