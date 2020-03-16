<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

/**
 * Интерфейс, определяющий логику
 * @package App\Interfaces
 */
interface IUserService
{
    function getUsersByRoleId(int $roleId);

    function getAllUsers();

    function getExecutors(): ?Collection;

    function postCreateUser(array $createParams): bool;
}
