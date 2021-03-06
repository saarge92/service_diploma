<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\ExecutorInOrder;
use App\Order;
use App\Status;
use App\Traits\ClientTrait;
use App\Comment;
use App\Http\Requests\PostCommentRequest;
use App\User;

trait ExecutorTrait
{
    use ClientTrait;

    /**
     * Получение заявок исполнителя
     *
     * @param Request $request Get-запрос
     * @return array Список заказов и статусов
     */
    private function getExecutorOrders(Request $request): array
    {
        $userId = $request->user()->id;
        $statusId = $request->get('statusId');
        $clientId = $request->get('clientId');
        $clientsId = Order::distinct('user_id')->pluck('user_id')->toArray();
        $allClients = User::whereIn('id', $clientsId)->get();
        $executorOrders = ExecutorInOrder::where(['user_id' => $userId])->pluck('order_id')->toArray();
        $orders = null;
        if ($statusId == 'new') {
            $orders = Order::whereIn('id', $executorOrders)->where(['status_id' => null]);
        } else {
            $statusId == null ? $orders = Order::whereIn('id', $executorOrders) : $orders = Order::whereIn('id', $executorOrders)->where(['status_id' => $statusId]);
        }
        if ($clientId != null) {
            $orders = $orders->where(['user_id' => $clientId]);
        }
        $orders = $orders->paginate(12);
        $parsedOrders = [];
        foreach ($orders as $order) {
            $parsedOrders[] = $this->parseOrder($order);
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
    private function getOrderById(int $id): array
    {
        $order = Order::find($id);
        $parsedOrder = $this->parseOrder($order);
        $statuses = Status::whereNotIn('name', ['Закрыта'])->get();
        $comments = Comment::where([
            'order_id' => $order != null ? $order->id : null
        ])->paginate(12);
        return [
            'order' => $parsedOrder,
            'comments' => $comments,
            'statuses' => $statuses
        ];
    }

    /**
     * Обработка отправки комментария
     *
     * @param Request $request Post-запрос
     * @return array Массив параметров с результатами операции
     */
    private function postComment(PostCommentRequest $request): array
    {
        $userId = $request->user()->id;
        $orderId = $request->get('orderId');
        $textComment = $request->get('textComment');
        $isAdmin = in_array('admin', $request->user()->roles->pluck('name')->toArray());
        $newComment = Comment::create([
            'user_id' => $userId,
            'order_id' => $orderId,
            'comments' => $textComment
        ]);
        $isCreated = $newComment->save();
        if ($isCreated) {
            return [
                'created' => $isCreated,
                'author' => $request->user()->name,
                'create_date' => $newComment->created_at->format('Y-m-d H:i:00'),
                'isAdmin' => $isAdmin,
                'id' => $newComment->id
            ];
        }
        return [
            'created' => false
        ];
    }

    /**
     * Обработка изменения статуса заявки исполнителем
     *
     */
    private function setStatusOrder($request): bool
    {
        $resultOperation = false;
        $orderId = $request->get('orderId');
        $statusId = $request->get('statusId');
        $order = Order::find($orderId);
        if ($order) {
            $order->status_id = $statusId;
            $resultOperation = $order->save();
        }
        return $resultOperation;
    }
}
