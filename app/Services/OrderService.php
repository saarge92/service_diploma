<?php

declare(strict_types=1);

namespace App\Services;

use App\Cart;
use App\Dto\Orders\OrderCreateDto;
use App\Interfaces\ServiceInOrdersServiceInterface;
use App\Order;
use App\Repository\Declarations\OrderRepositoryInterface;
use App\Service;
use App\Status;
use App\Interfaces\OrderServiceInterface;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

/**
 * Класс бизнес-логики, определяющий логику по работе с заказами
 *
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class OrderService implements OrderServiceInterface
{
    private OrderRepositoryInterface $orderRepository;
    private ServiceInOrdersServiceInterface $serviceInOrdersService;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ServiceInOrdersServiceInterface $serviceInOrdersService
    ) {
        $this->orderRepository = $orderRepository;
        $this->serviceInOrdersService = $serviceInOrdersService;
    }

    /**
     * Подтверждение заявки
     *
     * @param Cart $cart - Карта с заказами
     * @param int $userId - Id текущего пользователя, выполняющего заказ
     * @return bool - Булево значение, сохранен ли заказ
     * @throws \Exception
     */
    public function confirmOrderCheck(Cart $cart, int $userId): bool
    {
        DB::beginTransaction();
        try {
            $orderCreateDto = new OrderCreateDto(null, $userId, $cart->totalQty, $cart->totalPrice);
            $order = $this->orderRepository->createOrder($orderCreateDto);
            $this->serviceInOrdersService->saveOrderServicesInformation($cart, $order);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ConflictHttpException($exception->getMessage());
        }
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
        $services = $order->services->toArray();
        $previewText = [];
        foreach ($services as $item) {
            $previewText[] = $item["title"];
        }
        $row->previewText = $previewText;
        $row->created_at = $order->created_at;
        $row->updated_at = $order->updated_at;
        $row->totalQty = $order->total_qty;
        $row->totalSum = $order->total_price;
        $status = Status::find($order->status_id);
        $row->status = $status ? $status->name : 'Новая';
        $row->executors = $order->executors->pluck('name')->toArray();
        $row->cart = $order;
        $row->client = $order->user;
        $row->status_id = $order->status_id;
        return $row;
    }

    /**
     * Установка статуса для заявки
     * @param array $statusInfo Ассоциативный массив с параметрами
     * @return bool Установлен ли заказ
     */
    public function setStatusOrder(array $statusInfo): bool
    {
        $resultOperation = false;
        $orderId = $statusInfo['orderId'];
        $statusId = $statusInfo['statusId'];
        $order = Order::find($orderId);
        if ($order) {
            $order->status_id = $statusId;
            $resultOperation = $order->save();
        }
        return $resultOperation;
    }
}
