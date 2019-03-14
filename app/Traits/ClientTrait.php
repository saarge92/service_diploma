<?php

namespace App\Traits;

use App\Order;
use Illuminate\Http\Request;
use App\Cart;
use App\Status;
use App\Http\Requests\ChangeProfileRequest;
use App\UserInRole;

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
        $orders = Order::where(['status_id' => $statusId, 'user_id' => $currentUserId])
            ->orderby('created_at', $request->get('orderDate'))
            ->paginate(6);
        $parsedOrders = [];
        foreach ($orders as $order) {
            $parsedOrders[] = $this->parseOrder($order);
        }
        $statuses = Status::all();
        return [
            'orders' => $parsedOrders,
            'orderPaginate' => $orders,
            'statuses' => $statuses
        ];
    }

    /**
     * Получаем данные профиля клиента
     * 
     * @param Request $request - Get запрос
     */
    public function getProfileInfo(Request $request): array
    {
        $user = $request->user();
        return [
            'user' => $user
        ];
    }

    /**
     * Изменение профиля клиента
     */
    private function changeProfileUser(ChangeProfileRequest $request, $user): bool
    {
        $user->name = $request->name;
        $user->address = $request->address;
        $user->organization = $request->organization;
        $user->phone_number = $request->phone_number;
        return $user->save();
    }

    /**
     * Подтверждение заявки
     * 
     * @param Cart $cart - Карта с заказами
     * @param Request $request - Post-запрос
     * 
     * @return bool - Булево значение, сохранен ли заказ
     */
    public function confirmOrderCheck(Cart $cart, Request $request): bool
    {
        $order = new Order();
        $order->cart = serialize($cart);
        $order->user_id = $request->user()->id;
        return $order->save();
    }

    /**
     * Парсинг 1 заказа от клиентов в соответствующий вид
     * 
     * @param $order - заказ
     * 
     * @return object $result - заказ-объект
     */
    private function parseOrder($order): object
    {
        $row = new \stdClass();
        if (!is_null($order)) {
            try {
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
                $row->status_id = $order->status_id;
            } catch (\Exception $ex) {
                //continue;
                echo $ex->getMessage();
            }
        }
        return $row;
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
}
