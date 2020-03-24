<?php

namespace Tests\Unit;

use App\Cart;
use App\Interfaces\ICartService;
use App\Service;
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
}
