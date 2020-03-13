<?php

namespace App\Services;

use App\Interfaces\IRoleService;
use App\Role;

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
}
