<?php

namespace App\Services;

use App\Interfaces\IRoleService;
use App\Interfaces\IUserService;
use App\Role;
use App\User;
use App\UserInRole;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Создание пользователя в системе
     * @param array $createParams Параметры создания
     * @return bool
     */
    public function postCreateUser(array $createParams): bool
    {
        $user = User::create([
            'name' => $createParams['name'],
            'email' => $createParams['email'],
            'address' => $createParams['address'],
            'organization' => $createParams['organization'],
            'phone_number' => $createParams['phone_number'],
            'password' => Hash::make($createParams['password'])
        ]);
        if (isset($createParams['roleId'])) {
            $roleService = resolve(IRoleService::class);
            $roleService->grantRoleToUser($user->id, $createParams['roleId']);
        }
        return $user->save();
    }


    /**
     * Удаление пользователя
     * @param int $id Id удаляемого пользователя
     * @return bool Результат удаления
     */
    public function deleteUser(int $id): bool
    {
        $deleteResult = false;
        $deleteUser = User::find($id);
        if ($deleteUser) {
            $deleteResult = $deleteUser->delete();
        }
        return $deleteResult;
    }

    /**
     * Получение информации о пользователе
     *
     * @param int $userId Id пользователя
     * @return array Пользователь со списком ролей в базе
     */
    public function getUserInfo(int $userId): array
    {
        $user = User::find($userId);
        $roles = Role::all();
        return [
            'user' => $user,
            'roles' => $roles
        ];
    }
}
