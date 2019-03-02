<?php

namespace App\Traits;

use App\Order;
use Illuminate\Http\Request;
use App\User;
use App\Role;

/**
 * Трэйт, содержащий методы для работы администраторской части
 * 
 * Содержит методы, возвращающие необходимые данные для работы страниц администраторской части
 * 
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
trait AdminTrait
{

    /**
     * Получение списка пользователей в системе
     */
    private function getAllUsers(Request $request): array
    {
        $users = array();
        if ($request->has('roleId')) {
            $roleId = $request->get('roleId');
            $roles = User::with('roles.id');
            dd($roles->toSql());
            $users = User::with('roles.id')->where('roles.id', $roleId)->paginate(12);
        } else {
            $users = User::paginate(12);
        }
        $roles = Role::all();
        return [
            'users' => $users,
            'roles' => $roles
        ];
    }
}
