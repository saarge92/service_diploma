<?php
namespace App\Interfaces;

use App\Http\Requests\CreateServiceRequest;
use Illuminate\Http\Request;

/**
 * Базовый интерфейс для работы с таблицей "Услуги"
 */
interface IService
{
    public function createService(CreateServiceRequest $request): bool;
    public function getServices(Request $request);
}
