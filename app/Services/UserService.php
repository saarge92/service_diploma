<?php

namespace App\Services;

use App\Interfaces\IUserService;
use App\Role;
use App\User;
use App\UserInRole;
use Illuminate\Support\Collection;

/**
 * Class UserService, содержащий бизнес-логику по работе с пользователями
 * @package App\Services
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class UserService implements IUserService
{
    /**
     * Получаем пользователей по id ролей
     * @param int $roleId Id ролей
     * @return mixed Пагинированный список
     */
    public function getUsersByRoleId(int $roleId)
    {
        $user_in_roles = UserInRole::where(['role_id' => $roleId])->pluck('user_id')->toArray();
        return User::whereIn('id', $user_in_roles)->paginate(12);
    }

    /**
     * Получение списка всех пользователей
     * @return mixed Пагинированный список
     */
    public function getAllUsers()
    {
        return User::paginate(12);;
    }

    /**
     * Получение пользователей - исполнителей
     * @return Collection |null Коллекция доступных исполнителей заявок
     */
    public function getExecutors(): ?Collection
    {
        $roleExecutor = Role::where(['name' => 'executor'])->first();
        $availableExecutors = null;

        if ($roleExecutor != null) {
            $user_in_roles = UserInRole::where(['role_id' => $roleExecutor->id])->get();
            if (!$user_in_roles->isEmpty()) {
                $usersId = $user_in_roles->pluck('user_id')->toArray();
                $availableExecutors = User::whereIn('id', $usersId)->get();
            }
        }

        return $availableExecutors;
    }
}
