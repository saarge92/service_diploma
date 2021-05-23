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
interface OrderServiceInterface
{
    public function confirmOrderCheck(Cart $cart, int $userId): bool;

    public function getOrderById(int $id): object;

    public function parseOrder(Order $order): object;

    public function setStatusOrder(array $statusInfo): bool;
}
