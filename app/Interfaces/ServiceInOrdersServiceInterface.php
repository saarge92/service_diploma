<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Cart;
use App\Order;
use App\ServiceInOrder;

interface ServiceInOrdersServiceInterface
{
    /** @return ServiceInOrder[] */
    public function saveOrderServicesInformation(Cart $cart, Order $order): array;
}
