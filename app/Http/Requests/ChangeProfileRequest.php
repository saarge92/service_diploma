<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProfileRequest extends FormRequest
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
     * Returns messages of validation
     * @return array
     */
    public function messages(){
        return [
            'name.required' => 'Имя пользователя обязательно для заполнения',
            'address.required' => 'Адрес обязателен для заполнения',
            'organization.required' => 'Организация обязательна для заполнения',
            'phone_number.required' => 'Организация обязательна для заполнения',
            'phone_number.digits' => 'Номер должен быть в формате 8 XXX XXX XX XX (без пробелов)',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'name' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'organization' => 'required|min:2|max:255',
            'phone_number' => 'required|digits:11'
        ];
    }
}
