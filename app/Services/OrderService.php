<?php

namespace App\Services;

use App\Cart;
use App\Order;
use App\Status;
use App\Interfaces\IOrderService;

/**
 * Класс бизнес-логики, определяющий
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class OrderService implements IOrderService
{
    /**
     * Подтверждение заявки
     * 
     * @param Cart $cart - Карта с заказами
     * @param Request $request - Post-запрос
     * 
     * @return bool - Булево значение, сохранен ли заказ
     */
    public function confirmOrderCheck(Cart $cart, int $userId): bool
    {
        $order = new Order();
        $order->cart = serialize($cart);
        $order->user_id = $userId;
        return $order->save();
    }

    /**
     * Получение заказа по номеру и парсинг в 1 объект-заказ
     * 
     * @param int $id - номер заказа
     * 
     * @return object $order - объект-заказ, приведенный в соответствующий вид
     */
    public function getOrderById(int $id): object
    {
        $order = Order::find($id);
        $order = $this->parseOrder($order);
        return $order;
    }
    /**
     * Парсинг 1 заказа от клиентов в соответствующий вид
     * 
     * @param $order - заказ
     * 
     * @return object $result - заказ-объект
     */
    public function parseOrder(Order $order): object
    {
        $row = new \stdClass();

        $row->id = $order->id;
        $cart = new Cart(unserialize($order->cart));
        $previewText = [];
        foreach ($cart->items as $item) {
            $previewText[] = $item["item"]->title;
        }
        $row->previewText = $previewText;
        $row->created_at = $order->created_at;
        $row->updated_at = $order->updated_at;
        $row->totalQty = $cart->totalQty;
        $row->totalSum = $cart->totalPrice;
        $status = Status::find($order->status_id);
        $row->status = $status ? $status->name : 'Новая';
        $row->executors =  $order->executors->pluck('name')->toArray();
        $row->cart = $cart;
        $row->client = $order->user;
        $row->status_id = $order->status_id;
        return $row;
    }
}
