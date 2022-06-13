<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => 'required|integer',
            'name' => 'required|string|max:250',
            'status' => 'required|string',
            'importance' => 'required|string',
            'deadline' => 'date',
            'attachments' => 'nullable',
            'done_date' => 'nullable',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Название задачи обязательно к заполнению!',
        ];
    }
}
