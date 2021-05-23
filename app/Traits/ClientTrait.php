<?php

namespace App\Traits;

use App\Order;
use App\Services\OrderService;
use App\Status;
use Illuminate\Http\Request;

/**
 * Трэйт, содержащий методы для работы клиентской части
 *
 * Содержит методы, возвращающие необходимые данные для работы страниц клиентской части
 *
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
trait ClientTrait
{
    /**
     * Получение новых и незакрытых заявок клиента
     *
     * @param Request $request - http запрос
     * @return array - массив с заказами клиента
     */
    public function getDataForClientIndex(Request $request): array
    {
        $currentUserId = $request->user()->id;
        $statusId = $request->get('statusId');
        $statusId == 'all' ?
            $orders = Order::where(['user_id' => $currentUserId])->orderby('created_at', $request->get('orderDate'))
                ->paginate(6) : $orders = Order::where(['status_id' => $statusId, 'user_id' => $currentUserId])
            ->orderby('created_at', $request->get('orderDate'))
            ->paginate(6);
        $parsedOrders = [];
        $orderService = new OrderService();
        foreach ($orders as $order) {
            $parsedOrders[] = $orderService->parseOrder($order);
        }
        $statuses = Status::all();
        return [
            'orders' => $parsedOrders,
            'orderPaginate' => $orders,
            'statuses' => $statuses
        ];
    }
}
