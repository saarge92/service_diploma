<?php

namespace App\Services;

use App\Comment;
use App\ExecutorInOrder;
use App\Interfaces\IExecutorService;
use App\Interfaces\OrderServiceInterface;
use App\Order;
use App\Role;
use App\Status;
use App\User;
use App\UserInRole;

/**
 * Class ExecutorService, определяющий бизнес-логику по работе с исполнитеялми
 * заказов
 * @package App\Services
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class ExecutorService implements IExecutorService
{
    private OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Назначение исполнителя на заявку
     *
     * @param int $orderId Номер заявки
     * @param int $userId Исполнитель
     * @return bool Назначен ли исполнитель
     */
    public function assignExecutorToOrder(int $orderId, int $userId): bool
    {
        //Результат выполнения операции
        $response = false;

        //Назначен ли уже такой исполнитель на заявку
        $recordCount = ExecutorInOrder::where(
            [
                'user_id' => $userId,
                'order_id' => $orderId
            ]
        )->count();

        //Является ли назначаемый пользователь исполнителем
        $roleExecutor = Role::where(['name' => 'executor'])->first();
        $userInRole = UserInRole::where(
            [
                'user_id' => $userId,
                'role_id' => $roleExecutor->id
            ]
        )->count();

        if ($recordCount == 0 && $userInRole > 0) {
            $response = ExecutorInOrder::create(
                [
                    'order_id' => $orderId,
                    'user_id' => $userId
                ]
            )->save();
        }
        return $response;
    }

    /**
     * Убрать исполнителя из заявки
     *
     * @param int $orderId Номер заказа
     * @param int $userId Id пользователя
     * @return bool Булевое значение удален ли пользователь из исполнителей
     */
    public function revokeUserFromOrder(int $orderId, int $userId): bool
    {
        return ExecutorInOrder::where(
            [
                'order_id' => $orderId,
                'user_id' => $userId
            ]
        )->delete();
    }

    /**
     * Получение полной информации о заявках для исполнителя
     * @param array $userParams Параметры запроса для исполнителя заявок
     * @return array Массив, содержащий информации о перечнях заявок исполнителя
     */
    public function getExecutorOrders(array $userParams): array
    {
        $userId = $userParams['user']['id'];
        $statusId = isset($userParams['statusId']) ? $userParams['statusId'] : null;
        $clientId = isset($userParams['clientId']) ? $userParams['clientId'] : null;
        $clientsId = Order::distinct('user_id')->pluck('user_id')->toArray();
        $allClients = User::whereIn('id', $clientsId)->get();
        $executorOrders = ExecutorInOrder::where(['user_id' => $userId])->pluck('order_id')->toArray();
        $statusId == null ? $orders = Order::whereIn('id', $executorOrders) : $orders = Order::whereIn(
            'id',
            $executorOrders
        )->where(['status_id' => $statusId]);
        if ($clientId != null) {
            $orders = $orders->where(['user_id' => $clientId]);
        }
        $orders = $orders->paginate(12);
        $parsedOrders = [];
        foreach ($orders as $order) {
            $parsedOrders[] = $this->orderService->parseOrder($order);
        }
        $statuses = Status::all();
        return [
            'orders' => $parsedOrders,
            'statuses' => $statuses,
            'orderPaginate' => $orders,
            'allClients' => $allClients
        ];
    }

    /**
     * Получение информации о заказе
     *
     * @param int $id Номер заказа
     * @return array Параметры заказа
     */
    public function getOrderById(int $id): array
    {
        $order = Order::find($id);
        $parsedOrder = $this->orderService->parseOrder($order);
        $statuses = Status::whereNotIn('name', ['Закрыта'])->get();
        $comments = Comment::where(
            [
                'order_id' => $order != null ? $order->id : null
            ]
        )->paginate(12);
        return [
            'order' => $parsedOrder,
            'comments' => $comments,
            'statuses' => $statuses
        ];
    }
}
