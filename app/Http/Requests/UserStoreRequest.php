<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'password' => 'required|min:6',
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
            'email.required' => 'Email обязателен к заполнению!',
            'name.required' => 'ФИО обязательно к заполнению!',
            'password.required' => 'Пароль обязаетелен к заполнению!',
            'password.min'    => "Пароль должен быть не менее :min символов",
            'role.required' => "Не указана роль пользователя"
        ];
    }
}
