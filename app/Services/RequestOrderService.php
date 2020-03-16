<?php

namespace App\Services;

use App\Comment;
use App\ExecutorInOrder;
use App\Interfaces\IOrderService;
use App\Interfaces\IRequestOrderService;
use App\Interfaces\IUserService;
use App\Order;
use App\Status;
use App\User;

/**
 * Class RequestOrderService для работы с заказами пользователей
 * @package App\Services
 *
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class RequestOrderService implements IRequestOrderService
{

    private IUserService $userService;
    private IOrderService $orderService;

    public function __construct(IUserService $userService, IOrderService $orderService)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;
    }

    /**
     * Получение списка заказов
     * @param array $filterParams Параметры фильтрации
     * @return array Результируюший массив с заказами пользователей
     */
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
            $parsedOrders[] = $this->orderService->parseOrder($order);
        }
        return [
            'orders' => $parsedOrders,
            'orderPaginate' => $orders,
            'statuses' => $statuses,
            'allClients' => $allClients,
            'allExecutors' => $allExecutors
        ];
    }

    /**
     * Получение данных по 1 заявке
     * @param int $id Id заявки, которую хотим получить
     * @return array Массив данных с информацией о заявке
     */
    public function getOrderById(int $id): array
    {
        $order = Order::find($id);
        $parsedOrders = $this->orderService->parseOrder($order);
        $executors = $order->executors;
        $comments = Comment::where([
            'order_id' => $order != null ? $order->id : null
        ])->paginate(12);
        $availableExecutors = $this->userService->getExecutors();
        if ($availableExecutors) {
            $availableExecutors = $availableExecutors->whereNotIn(
                'id',
                $executors->pluck('id')->toArray()
            );
        }
        $statuses = Status::all();
        return [
            'order' => $parsedOrders,
            'executors' => $executors,
            'availableExecutors' => $availableExecutors,
            'comments' => $comments,
            'statuses' => $statuses
        ];
    }
}
