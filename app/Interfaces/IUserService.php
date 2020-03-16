<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

/**
 * Интерфейс, определяющий логику
 * @package App\Interfaces
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
interface IUserService
{
    function getUsersByRoleId(int $roleId);

    function getAllUsers();

    function getExecutors(): ?Collection;

    function postCreateUser(array $createParams): bool;

    function deleteUser(int $id): bool;
}
