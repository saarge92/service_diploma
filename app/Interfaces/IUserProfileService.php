<?php

namespace App\Interfaces;

/**
 * Интерфейс, определяющий
 */
interface IUserProfileService
{
    function changeUserInfo(int $userId, array $userParams);
}
