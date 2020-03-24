<?php

namespace Tests\Unit;

use App\Interfaces\IExecutorService;
use App\Order;
use App\User;
use Tests\TestCase;


/**
 * Тестирование функционала ExecutorService, определяющий
 * бизнес-логику по работе с исполнитеялми заказов
 * @package Tests\Unit
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class ExecutorServiceTest extends TestCase
{
    /**
     * Тестирование назначения исполнителя на заявку
     *
     * Должен вернуть true/false в результате
     */
    public function testAssignExecutorToOrder()
    {
        $executorService = $this->getExecutorOrderService();
        $randomOrder = Order::orderByRaw("RAND()")->first();
        $randomUser = User::orderByRaw("RAND()")->first();

        $result = $executorService->assignExecutorToOrder($randomOrder['id'], $randomUser['id']);

        $this->assertIsBool($result);
        $this->assertEquals($result, true);
    }

    /**
     * Получение зависимости ExecutorService для тестирования
     * @return IExecutorService
     */
    private function getExecutorOrderService(): IExecutorService
    {
        return resolve(IExecutorService::class);
    }
}
