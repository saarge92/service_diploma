<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'phone' => ['required', 'string', 'digits:11'],
            'comments' => ['string', 'max:255']
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
            'name.required' => 'ФИО обязательно для заполнения',
            'phone.digits' => 'Номер должен быть в формате 8 XXX XXX XX XX (без пробелов)',
        ];
    }
}
