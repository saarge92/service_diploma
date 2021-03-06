<?php

namespace Tests\Unit;

use App\Cart;
use App\Interfaces\OrderServiceInterface;
use App\Order;
use App\Service;
use App\Status;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Тестирование сервис-класса Order Service
 * Тестирования функционала добавления заказов в корзину
 * @package Tests\Unit
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class OrderServiceTest extends TestCase
{
    /**
     * Тестирование функционала подтверждение заказа
     *
     * Должен вернуть true в случае успешного обновления
     */
    public function testConfirmOrderCheck()
    {
        $cart = new Cart(null);
        $randomServiceInDatabase = Service::orderByRaw("RAND()")->first();
        $randomUser = User::orderByRaw("RAND()")->first();
        $orderService = $this->getOrderServiceDependency();

        $cart->add($randomServiceInDatabase, $randomServiceInDatabase['id']);
        $resultConfirm = $orderService->confirmOrderCheck($cart, $randomUser['id']);

        $this->assertEquals($resultConfirm, true);
    }

    /**
     * Тестирование получения заказа по Id
     * Тестирование метода getOrderById
     * Должен вернуть объект в ответе
     */
    public function testGetOrderById()
    {
        $orderService = $this->getOrderServiceDependency();
        $randomOrder = Order::orderByRaw("RAND()")->first();

        $orderResult = $orderService->getOrderById($randomOrder['id']);

        $this->assertEquals(is_object($orderResult), true);
    }

    /**
     * Тестирование функционала для парсинга заказов
     * Тестирование метода parseOrder
     */
    public function testParseOrder()
    {
        $orderService = $this->getOrderServiceDependency();
        $randomOrder = Order::orderByRaw("RAND()")->first();

        $parsedOrderResult = $orderService->parseOrder($randomOrder);

        $this->assertEquals(is_object($parsedOrderResult), true);
        $this->assertObjectHasAttribute('previewText', $parsedOrderResult);
        $this->assertObjectHasAttribute('totalQty', $parsedOrderResult);
    }

    /**
     * Тестирование установки нового статуса для заказа
     * Тестирование метода setStatusOrder
     * Должен вернуть  true в случае успешной установки статуса
     */
    public function testSetStatusOrder()
    {
        $orderService = $this->getOrderServiceDependency();
        $randomOrder = Order::orderByRaw("RAND()")->first();
        $randomStatus = Status::orderByRaw("RAND()")->first();

        $statusInfo = [
            'orderId' => $randomOrder['id'],
            'statusId' => $randomStatus['id']
        ];
        $result = $orderService->setStatusOrder($statusInfo);

        $this->assertEquals($result, true);
    }

    /**
     * Получение зависимости функционала OrderService из контейнера зависимостей
     * @return OrderServiceInterface Возвращает зависимость с необходимым функционалом
     * класс OrderService
     */
    private function getOrderServiceDependency(): OrderServiceInterface
    {
        return resolve(OrderServiceInterface::class);
    }
}
