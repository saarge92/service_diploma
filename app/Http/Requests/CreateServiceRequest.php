<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'path' => ['required']
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
            'title.required' => 'Название обязательно для заполнения',
            'content.required' => 'Описание обязательно для заполнения',
            'price.required' => 'Цена обязательна для выполнения',
            'path.required' => 'Загрузите изображение',
            'price.numeric' => 'Цена должна иметь численное значение'
        ];
    }
}
