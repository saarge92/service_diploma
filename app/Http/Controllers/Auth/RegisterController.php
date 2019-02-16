<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/client/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = $this->messages();
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'digits:11'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], $messages);
    }

    /**
     * Метод, возвращающий сообщения валидации
     * 
     * @return array - массив параметров
     */
    protected function messages() : array
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => 'dsfsdfsdf',
            'organization' => $data['organization'],
            'phone_number' => $data['phone_number'],
        ]);
    }
}
