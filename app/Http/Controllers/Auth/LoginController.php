<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Перенаправление в случае, если пользователь имеет определенные роли
     */
    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        $rolesUser = $user->roles->pluck('name')->toArray();
        if (in_array('admin', $rolesUser)) {
            $this->redirectTo = '/admin/index';
            return;
        }
        if (in_array('executor', $rolesUser)) {
            $this->redirectTo = '/executor/index';
            return;
        }
    }
}
