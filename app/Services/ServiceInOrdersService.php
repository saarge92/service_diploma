<?php

declare(strict_types=1);

namespace App\Services;

use App\Cart;
use App\Interfaces\ServiceInOrdersServiceInterface;
use App\Order;
use App\ServiceInOrder;

class ServiceInOrdersService implements ServiceInOrdersServiceInterface
{

    /**
     * @return ServiceInOrder[]
     */
    public function saveOrderServicesInformation(Cart $cart, Order $order): array
    {
        $createRecords = [];
        foreach ($cart->items as $serviceItem) {
            $serviceInOrder = new ServiceInOrder();
            $serviceInOrder['id_order'] = $order['id'];
            $serviceInOrder['id_service'] = $serviceItem['item']['id'];
            $serviceInOrder['quantity'] = $serviceItem['qty'];
            $serviceInOrder['price'] = $serviceItem['price'];
            $serviceInOrder->save();
            $createRecords[] = $serviceInOrder;
        }
        return $createRecords;
    }
}
