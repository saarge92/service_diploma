<?php
namespace App\Interfaces;

use App\Http\Requests\CreateServiceRequest;
use Illuminate\Http\Request;
use App\Http\Requests\EditServiceRequest;

/**
 * Базовый интерфейс для работы с таблицей "Услуги"
 */
interface IService
{
    public function createService(CreateServiceRequest $request): bool;
    public function getServices(Request $request);
    public function editService(EditServiceRequest $request);
    public function deleteService(int $id):bool;
}
