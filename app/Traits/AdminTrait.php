<?php

namespace App\Traits;

use App\Order;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\UserInRole;
use App\Traits\ClientTrait;
use App\ExecutorInOrder;
use Illuminate\Http\JsonResponse;

/**
 * Трэйт, содержащий методы для работы администраторской части
 * 
 * Содержит методы, возвращающие необходимые данные для работы страниц администраторской части
 * 
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
trait AdminTrait
{

    use ClientTrait;
    /**
     * Получение списка пользователей в системе
     * 
     * @param Request $request - Get Запрос
     * @return array - массив параметров для отображения
     */
    private function getAllUsers(Request $request): array
    {
        $users = array();
        if ($request->has('roleId')) {
            $roleId = $request->get('roleId');
            $user_in_roles = UserInRole::where(['role_id' => $roleId])->pluck('user_id')->toArray();
            $users = User::whereIn('id', $user_in_roles)->paginate(12);
        } else {
            $users = User::paginate(12);
        }
        $roles = Role::all();
        return [
            'users' => $users,
            'roles' => $roles
        ];
    }

    /**
     * Получение списка заявок для администора
     * 
     * @param Request $request Get запрос
     * @return array Список заказов
     */
    private function getAllRequests(Request $request): array
    {
        $orders = Order::paginate(12);
        $parsedOrders = [];
        foreach ($orders as $order) {
            $parsedOrders[] = $this->parseOrder($order);
        }
        return [
            'orders' => $parsedOrders,
            'orderPaginate' => $orders
        ];
    }

    /**
     * Отображение информации об 1 заявке
     */
    private function getOrderById(int $id): array
    {
        $order = Order::find($id);
        $parsedOrders = $this->parseOrder($order);
        $executors = $order->executors;
        $availableExecutors = $this->getExecutors();
        return [
            'order' => $parsedOrders,
            'executors' => $executors,
            'availableExecutors' => $availableExecutors
        ];
    }

    /**
     * Получение списка пользователей с ролью "Исполнитель"
     */
    private function getExecutors()
    {
        $roleExecutor = Role::where(['name' => 'executor'])->first();
        $availableExecutors = null;

        if ($roleExecutor != null) {
            $user_in_roles = UserInRole::where(['role_id' => $roleExecutor->id])->get();
            if (!$user_in_roles->isEmpty()) {
                $usersId = $user_in_roles->pluck('user_id')->toArray();
                $availableExecutors = User::whereIn('id', $usersId)->get();
            }
        }

        return $availableExecutors;
    }

    /**
     * Назначение исполнителя на заявку
     * 
     * @param int $orderId Номер заявки
     * @param int $userId Исполнитель
     * @return bool Назначен ли исполнитель
     */
    private function assignExecutorToOrder(int $orderId, int $userId): bool
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
}
