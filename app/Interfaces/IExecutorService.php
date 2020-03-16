<?php

namespace App\Interfaces;

/**
 * Interface IExecutorService определяющий методы работы сервиса ExecutorService,
 * отвечающий за бизнес-логику по работе
 * @package App\Interfaces
 */
interface IExecutorService
{
    function assignExecutorToOrder(int $orderId, int $userId): bool;

    function revokeUserFromOrder(int $orderId, int $userId): bool;
}
