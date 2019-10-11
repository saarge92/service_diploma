<?php

namespace App\Services;

use App\Interfaces\IUserProfileService;
use App\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Сервис, содержащий бизнес-логику по работе с профилем пользователя
 * 
 */
class UserProfileImpl implements IUserProfileService
{
    /**
     * Изменение информации о пользователе
     * @param int $userId Id пользователя
     * @param array $userParams Параметры инициализации пользователя
     */
    public function changeUserInfo(int $userId, array $userParams)
    {
        $user = $this->findUserById($userId);
        $user->name = $userParams['name'];
        $user->address = $userParams['address'];
        $user->organization = $userParams['organization'];
        $user->phone_number = $userParams['phone_number'];
        return $user->save();
    }

    /**
     * Поиск пользователя по Id
     * @param int $userId Id пользователя
     * @throws HttpException Исключение в случае не найденного пользователя
     * @return User Найденный пользователь
     */
    public function findUserById(int $userId): User
    {
        $user = User::find($userId);
        if (!$user) return new HttpException(404, "Пользователь не найден");
        return $user;
    }
}
