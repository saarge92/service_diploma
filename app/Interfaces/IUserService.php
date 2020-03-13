<?php

namespace App\Interfaces;

/**
 * Интерфейс, определяющий логику
 * @package App\Interfaces
 */
interface IUserService
{
    function getUsersByRoleId(int $roleId);

    function getAllUsers();
}
