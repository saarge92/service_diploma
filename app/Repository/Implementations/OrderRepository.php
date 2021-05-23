<?php

declare(strict_types=1);

namespace App\Repository\Implementations;

use App\Dto\Orders\OrderCreateDto;
use App\Order;
use App\Repository\Declarations\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{

    public function createOrder(OrderCreateDto $createDto): Order
    {
        $order = new Order();
        $order['user_id'] = $createDto->getUserId();
        $order['status_id'] = $createDto->getStatusId();
        $order['total_qty'] = $createDto->getTotalQty();
        $order['total_price'] = $createDto->getTotalPrice();
        $order->save();
        return $order;
    }
}
