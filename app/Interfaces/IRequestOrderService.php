<?php

namespace App\Interfaces;

/**
 * Interface IRequestOrderService, определяющий
 * бизнес-логику по работе с заказами
 * @package App\Interfaces
 */
interface IRequestOrderService
{
    function getAllRequests(array $filterParams): array;

    function getOrderById(int $id): array;

    function deleteRequestById(int $id): bool;
}
