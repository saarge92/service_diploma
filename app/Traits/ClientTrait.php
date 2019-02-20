<?php

namespace App\Traits;

use App\Order;
use Illuminate\Http\Request;
use App\Cart;

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
    public function getDataForClientIndex(Request $request) : array
    {
        $currentUserId = $request->user()->id;
        $orders = Order::where(['status_id' => null, 'user_id' => $currentUserId])->paginate(8);
        $parsedOrders = $this->parseOrders($orders);
        return [
            'orders' => $parsedOrders,
        ];
    }

    /**
     * Подтверждение заявки
     * 
     * @param Cart $cart - Карта с заказами
     * @param Request $request - Post-запрос
     * 
     * @return bool - Булево значение, сохранен ли заказ
     */
    public function confirmOrderCheck(Cart $cart, Request $request) : bool
    {
        $order = new Order();
        $order->cart = serialize($cart);
        $order->user_id = $request->user()->id;
        return $order->save();
    }

    /**
     * Парсинг списка заказов от клиентов в соответствующий вид
     * 
     * @param $orders - список заказов
     * 
     * @return array $result - список заказов
     */
    private function parseOrders($orders) : array
    {
        $result = array();
        foreach ($orders as $order) {
            try {
                $row = (object)null;
                $row->id = $order->id;
                $cart = new Cart(unserialize($order->cart));
                $previewText = "";
                foreach ($cart->items as $item) {
                    $previewText .= $item["item"]->title .',';
                }
                $row->previewText = $previewText;
                $row->created_at = $order->created_at;
                $row->updated_at = $order->updated_at;
                $result[] = $row;
            } catch (\Exception $ex) {
                //continue;
                echo $ex->getMessage();
            }
        }
        return $result;
    }
}