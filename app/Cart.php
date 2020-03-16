<?php

namespace App;

/**
 * Класс для работы с корзиной заказов
 *
 * Содержит базовые методы для работы с корзиной
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class Cart
{
    public array $items = [];
    public int $totalQty = 0;
    public float $totalPrice = 0;

    /**
     * Класс-конструктор для создания экземпляра объекта
     *
     * @param Cart $oldCart Старая карта заказа, хранящаяся в
     */
    public function __construct(?Cart $oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }

    }

    /**
     * Добавляет элемент в корзину
     *
     * @param $item - услуга
     * @param $id - id-номер услуги
     */
    public function add($item, int $id): void
    {
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item
        ];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    /**
     * Уменьшает корзину на 1 пункт
     *
     * @param $id - id услуги
     */
    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    /**
     * Увеличивает корзину на 1 услугу
     *
     * @param $id - id услуги
     */
    public function increaseByOne($id)
    {
        $this->items[$id]['qty']++;
        $this->items[$id]['price'] += $this->items[$id]['item']['price'];
        $this->totalQty++;
        $this->totalPrice += $this->items[$id]['item']['price'];
    }

    /**
     * Убирает полностью услугу с корзины
     *
     * @param $id - id услуги
     */
    public function reduceItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }

}
