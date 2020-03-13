<?php

namespace App\Services;

use App\ExecutorInOrder;
use App\Interfaces\IRequestOrderService;
use App\Order;
use App\Status;
use App\User;

class RequestOrderService implements IRequestOrderService
{

    public function getAllRequests(array $filterParams): array
    {
        //Получение списка клиентов
        $clientsId = Order::distinct('user_id')->pluck('user_id')->toArray();
        $allClients = User::whereIn('id', $clientsId)->get();

        //Получение списка заказов
        $executorsId = ExecutorInOrder::distinct('user_id')->pluck('user_id')->toArray();
        $allExecutors = User::whereIn('id', $executorsId)->get();

        $orders = null;
        if (isset($filterParams['statusId'])) {
            if ($filterParams['statusId'] == 'new') $orders = Order::where(['status_id' => null]);
            else $orders = Order::where(['status_id' => $filterParams['statusId']]);
        } else $orders = Order::where('id', '!=', null);

        if (isset($filterParams['clientId'])) {
            $orders = $orders->where(['user_id' => $filterParams['clientId']]);
        }

        if (isset($filterParams['executorId'])) {
            $executorOrders = ExecutorInOrder::where(['user_id' => $filterParams['executorId']])->pluck('order_id');
            $orders = $orders->whereIn('id', $executorOrders);
        }
        $orders = $orders->paginate(12);

        $statuses = Status::all();
        $parsedOrders = [];
        foreach ($orders as $order) {
            $parsedOrders[] = $this->parseOrder($order);
        }
        return [
            'orders' => $parsedOrders,
            'orderPaginate' => $orders,
            'statuses' => $statuses,
            'allClients' => $allClients,
            'allExecutors' => $allExecutors
        ];
    }
}
