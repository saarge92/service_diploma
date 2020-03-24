<?php

namespace App\Services;

use App\Cart;
use App\Service;

use App\Interfaces\ICartService;
use Illuminate\Support\Facades\Session;

/**
 * Сервис, определяющий бизнес-логику с картой заказа
 *
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class CartServiceImpl implements ICartService
{
    /**
     * Добавление карты в сессию
     * @param int $id Id услуги, добавляемая в карту заказа
     * @return Cart Новая карта заказа с новой добавленной услугой
     */
    public function addCartToItem(int $id): Cart
    {
        $service = Service::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        if ($service) {
            $cart = new Cart($oldCart);
            $cart->add($service, $service->id);
            return $cart;
        }
        return $oldCart;
    }

    /**
     * Получение информации о  текущей корзине
     *
     * @return array $result - список
     */
    public function getCartInfo(): array
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $result = array(
            'orders' => $cart->items,
            'totalPrice' => $cart->totalPrice
        );
        return $result;
    }

    /**
     * Уменьшение 1 позиции в корзине
     *
     * @param int $id Id услуги в корзине
     * @return array $newCartResult Возвращает параметры корзины
     */
    public function reduceItem(int $id): array
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->reduceByOne($id);
        Session::put('cart', $newCart);
        $newCartResult = $this->getUpdatedResult($newCart, $id);
        return $newCartResult;
    }

    /**
     * Увеличение корзины на 1 позицию
     * @param int $id - номер услуги в корзине
     * @return array
     */
    public function increaseItem(int $id): array
    {
        $oldcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->increaseByOne($id);
        Session::put('cart', $cart);
        return $this->getUpdatedResult($cart, $id);
    }

    /**
     * Удаление услуги полностью
     *
     * @param int $id - id услуги
     *
     * @return array $updated_results - измененные параметры корзины
     */
    public function deleteItem(int $id): array
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceItem($id);
        Session::put('cart', $cart);
        $updated_results['totalQty'] = $cart->totalQty;
        $updated_results['totalPrice'] = $cart->totalPrice;
        return $updated_results;
    }

    /**
     * Возвращает измененные параметры корзины
     *
     * @param Cart $cart - корзина
     * @param int $id - id услуги
     *
     * @return array $updated_results - измененные параметры корзины
     */
    private function getUpdatedResult(Cart $cart, int $id): array
    {
        $updated_results['count_of_element'] = isset($cart->items[$id]['qty']) ? $cart->items[$id]['qty'] : 0;
        $updated_results['price'] = isset($cart->items[$id]['price']) ? $cart->items[$id]['price'] : 0;
        $updated_results['totalQty'] = $cart->totalQty;
        $updated_results['totalPrice'] = $cart->totalPrice;
        return $updated_results;
    }
}
