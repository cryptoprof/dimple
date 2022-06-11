<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
            'name' => 'required|string|max:250',
            'date_start' => 'date',
            'date_end' => 'date',
            'description' => 'nullable'
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
            'name.required' => 'Название проекта обязательно к заполнению!',
            'date_start' => 'Дата начала проекта обязаетельна к заполнению!',
            'date_end' => 'Дата окончания проекта обязаетельна к заполнению!',
        ];
    }
}
