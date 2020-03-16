<?php

namespace App\Interfaces;

use App\Cart;

/**
 * Интерфейс, определяющий бизнес-логику по работе с Картой заказа
 *
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
interface ICartService
{
    function addCartToItem(int $id): Cart;

    function getCartInfo(): array;

    function reduceItem(int $id): array;

    function deleteItem(int $id): array;
}
