<?php

namespace App\Services;

use App\Interfaces\IRoleService;
use App\Role;
use App\UserInRole;

/**
 * Class RoleService, определяющий бизнес-логику
 * по работе с ролями в системе
 * @package App\Services
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class RoleService implements IRoleService
{

    /**
     * Получение спипска ролей
     * @return Role[]|\Illuminate\Database\Eloquent\Collection Коллекция ролей
     */
    public function getAll()
    {
        return Role::all();
    }

    /**
     * Удаление пользователя из роли
     * @param int $userId Id пользователя
     * @param int $roleId Номер роли
     * @return bool Результат операции
     */
    public function revokeRole(int $userId, int $roleId): bool
    {
        $result = false;
        $userInRole = UserInRole::where(['user_id' => $userId, 'role_id' => $roleId]);
        if ($userInRole) {
            $result = $userInRole->delete();
        }
        return $result;
    }

    /**
     * Реализация добавления роли для пользователя
     *
     * @param int $userId Id пользователя
     * @param int $roleId Номер роли
     * @return string Результат добавления
     */
    public function grantRoleToUser(int $userId, int $roleId): string
    {
        $resultGrant = '';
        $userInRole = UserInRole::where(['user_id' => $userId, 'role_id' => $roleId])->count();
        if ($userInRole > 0) {
            $resultGrant = 'existed';
        } else {
            $newUserInRole = UserInRole::create(['user_id' => $userId, 'role_id' => $roleId])->save();
            $newUserInRole == true ? $resultGrant = 'created' : $result = 'error';
        }
        return $resultGrant;
    }
}
