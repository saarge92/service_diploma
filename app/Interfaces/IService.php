<?php
namespace App\Interfaces;

use App\Http\Requests\CreateServiceRequest;

/**
 * Базовый интерфейс для работы с таблицей "Услуги"
 */
interface IService
{
    public function createService(CreateServiceRequest $request): bool;
}
