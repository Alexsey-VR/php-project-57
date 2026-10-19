<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('tasks', 'name')->ignore($this->route('task'))
            ],
            'description' => ['nullable','string', 'max:512'],
            'status_id' => ['required', 'integer', 'exists:task_statuses,id'],
            'assigned_to_id' => ['required', 'integer', 'exists:users,id'],
            'labels' => ['array'],
            'labels.*' => ['nullable', 'integer', 'exists:labels,id'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.unique' => __('flash.task.dublicated')
        ];
    }
}
