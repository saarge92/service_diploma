<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\ExecutorInOrder;
use App\Order;
use App\Status;
use App\Traits\ClientTrait;
use App\Comment;
use App\Http\Requests\PostCommentRequest;

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
        $executorOrders = ExecutorInOrder::where(['user_id' => $userId])->pluck('order_id')->toArray();
        $orders = Order::whereIn('id', $executorOrders)->where(['status_id' => $statusId])->paginate(12);
        $parsedOrders = [];
        foreach ($orders as $order) {
            $parsedOrders[] = $this->parseOrder($order);
        }
        $statuses = Status::all();
        return [
            'orders' => $parsedOrders,
            'statuses' => $statuses,
            'orderPaginate' => $orders
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
        $comments = Comment::where([
            'order_id' => $order != null ? $order->id : null
        ])->paginate(12);
        return [
            'order' => $parsedOrder,
            'comments' => $comments
        ];
    }

    /**
     * Обработка отправки комментария
     * 
     * @param Request $request Post-запрос
     */
    private function postComment(PostCommentRequest $request): bool
    {
        $userId = $request->user()->id;
        $orderId = $request->get('orderId');
        $textComment = $request->get('textComment');
        $isCreated = Comment::create([
            'user_id' => $userId,
            'order_id' => $orderId,
            'comments' => $textComment
        ])->save();
        return $isCreated;
    }
}
