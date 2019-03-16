<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'digits:11'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }
    /**
     * Метод, возвращающий сообщения валидации
     * 
     * @return array - массив параметров
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Имя пользователя обязательно для заполнения',
            'email.required' => 'Email-почта обязательна для заполнения',
            'address.required' => 'Адрес обязателен для заполнения',
            'organization.required' => 'Организация обязательна для заполнения',
            'phone_number.required' => 'Организация обязательна для заполнения',
            'password.required' => 'Пароль обязательны для заполнения',

            'email.email' => 'Поле должно содержать почту. К пример user@example.com',
            'email.unique' => 'Пользователь уже существует в базе',
            'phone_number.digits' => 'Номер должен быть в формате 8 XXX XXX XX XX (без пробелов)',
            'password.min' => 'Минимальная длина пароля 6 символов',
            'password.confirmed' => 'Подтверждение пароля не совпадает'
        ];
    }
}
