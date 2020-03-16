<?php

namespace App\Services;

use App\ExecutorInOrder;
use App\Interfaces\IExecutorService;
use App\Role;
use App\UserInRole;

/**
 * Class ExecutorService, определяющий бизнес-логику по работе с исполнитеялми
 * заказов
 * @package App\Services
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class ExecutorService implements IExecutorService
{

    /**
     * Назначение исполнителя на заявку
     *
     * @param int $orderId Номер заявки
     * @param int $userId Исполнитель
     * @return bool Назначен ли исполнитель
     */
    public function assignExecutorToOrder(int $orderId, int $userId): bool
    {
        //Результат выполнения операции
        $response = false;

        //Назначен ли уже такой исполнитель на заявку
        $recordCount = ExecutorInOrder::where([
            'user_id' => $userId,
            'order_id' => $orderId
        ])->count();

        //Является ли назначаемый пользователь исполнителем
        $roleExecutor = Role::where(['name' => 'executor'])->first();
        $userInRole = UserInRole::where([
            'user_id' => $userId,
            'role_id' => $roleExecutor->id
        ])->count();

        if ($recordCount == 0 && $userInRole > 0) {
            $response = ExecutorInOrder::create([
                'order_id' => $orderId,
                'user_id' => $userId
            ])->save();
        }
        return $response;
    }

    /**
     * Убрать исполнителя из заявки
     *
     * @param int $orderId Номер заказа
     * @param int $userId Id пользователя
     * @return bool Булевое значение удален ли пользователь из исполнителей
     */
    public function revokeUserFromOrder(int $orderId, int $userId): bool
    {
        $result = ExecutorInOrder::where([
            'order_id' => $orderId,
            'user_id' => $userId
        ])->delete();
        return $result;
    }
}
