<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'password' => 'nullable|min:6',
            'role' => 'required'
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
            'name.required' => 'ФИО обязательно к заполнению!',
            'password.required' => 'Пароль обязаетелен к заполнению!',
            'password.min'    => "Пароль должен быть не менее :min символов",
            'role.required' => "Не указана роль пользователя"
        ];
    }
}
