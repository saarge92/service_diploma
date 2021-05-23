<?php

namespace App\Interfaces;

/**
 * Interface IRequestOrderService, определяющий
 * бизнес-логику по работе с заказами
 * @package App\Interfaces
 */
interface IRequestOrderService
{
    public function getAllRequests(array $filterParams): array;

    public function getOrderById(int $id): array;

    public function deleteRequestById(int $id): bool;
}
