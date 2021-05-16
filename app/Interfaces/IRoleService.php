<?php

namespace App\Interfaces;

use App\Role;
use Illuminate\Database\Eloquent\Collection;

/**
 * Интерфейс IRoleService, определяющий бизнес-логику по работе
 * с ролями в системе
 * @package App\Interfaces
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
interface IRoleService
{
    public function getAll(): Collection;

    public function revokeRole(int $userId, int $roleId): bool;

    public function grantRoleToUser(int $userId, int $roleId): string;

    public function findByName(string $name): ?Role;
}
