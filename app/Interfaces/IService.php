<?php

namespace App\Interfaces;

use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\EditServiceRequest;

/**
 * Базовый интерфейс для работы с таблицей "Услуги"
 */
interface IService
{
    public function createService(array $createParams): Service;
    public function editService(int $id, array $editParams): Service;
    public function deleteService(int $id): bool;
    public function getServices();
}
