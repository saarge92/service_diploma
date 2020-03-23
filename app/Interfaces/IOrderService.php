<?php

namespace App\Interfaces;

use App\Cart;
use App\Order;

/**
 * Интерфейс, определяющий методы бизнес логики по работе с заказами клиента
 *
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
interface IOrderService
{
    function confirmOrderCheck(Cart $cart, int $userId): bool;

    function getOrderById(int $id): object;

    function parseOrder(Order $order): object;

    function setStatusOrder(array $statusInfo): bool;
}
