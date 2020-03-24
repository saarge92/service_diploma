<?php

namespace Tests\Unit;

use App\Cart;
use App\Interfaces\ICartService;
use App\Service;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Класс для тестирования функционала CartServiceImpl,
 * содержащий бизнес-логику для работы с картой заказа
 * (добавлению в сессию карту и прочее)
 *
 * @package Tests\Unit
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class CartServiceTest extends TestCase
{
    /**
     * Тестирование функционала добавления
     * в карту заказа услуги
     *
     * Должен вернуть новую карту заказа из сесии
     */
    public function testAddCartToItem()
    {
        $cartService = $this->getCartServiceDependency();
        $randomService = Service::orderByRaw("RAND()")->first();

        $result = $cartService->addCartToItem($randomService['id']);

        $this->assertInstanceOf(Cart::class, $result);
    }

    /**
     * Получение зависимости класса CartServiceImpl
     * @return ICartService Функционал по работе с картой
     */
    private function getCartServiceDependency(): ICartService
    {
        return resolve(ICartService::class);
    }

    /**
     * Тестирование функционала получения информации о карте заказа
     * Должен вернуть ассоциативный массив данных о заказе
     */
    public function testGetCartInfo()
    {
        $cartService = $this->getCartServiceDependency();

        $result = $cartService->getCartInfo();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('orders', $result);
        $this->assertArrayHasKey('totalPrice', $result);
    }

    /**
     * Тестирование добавления в корзину услуги
     * Должен вернуть обновленную корзину заказов
     */
    public function testIncreaseItem()
    {
        $cartService = $this->getCartServiceDependency();
        $randomService = Service::orderByRaw("RAND()")->first();

        $cart = new Cart(null);
        $cart->add($randomService, $randomService['id']);
        Session::put('cart', $cart);
        $result = $cartService->increaseItem($randomService['id']);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('count_of_element', $result);
        $this->assertArrayHasKey('price', $result);
        $this->assertArrayHasKey('totalQty', $result);
        $this->assertArrayHasKey('totalPrice', $result);
    }
}
