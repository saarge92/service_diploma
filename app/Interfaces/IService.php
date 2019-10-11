<?php

namespace App\Interfaces;

use App\Service;

/**
 * Базовый интерфейс для работы с таблицей "Услуги"
 * 
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
interface IService
{
    public function createService(array $createParams): Service;
    public function editService(int $id, array $editParams): Service;
    public function deleteService(int $id): bool;
    public function getServices();
}
