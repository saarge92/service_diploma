<?php

namespace App\Repository\Declarations;

use App\Dto\Orders\OrderCreateDto;
use App\Order;

interface OrderRepositoryInterface
{
    public function createOrder(OrderCreateDto $createDto): Order;
}
