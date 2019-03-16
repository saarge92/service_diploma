<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AdminTrait;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Session;

/**
 * Контроллер Администратора
 * 
 * Содержит методы для генерации страниц в админке
 * 
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class AdminController extends Controller
{
    use AdminTrait;

    /**
     * Генерация индексной страницы пользователя
     * 
     * @param Request $request - Get-запрос
     * @return View Отображает страницу со списком всех пользоватлей
     */
    public function index(Request $request): View
    {
        $data = $this->getAllUsers($request);
        return view('admin.index', $data);
    }

    /**
     * Отображение списка всех заявок
     * 
     * @param Request $request Get Запрос
     * @return View Отображает страницу со списком всех заказов
     */
    public function viewRequests(Request $request): View
    {
        $data = $this->getAllRequests($request);
        return view('admin.allOrders', $data);
    }

    /**
     * Генерация конкретного заказа
     * @param int $id Номер услуги
     */
    public function viewOrder(int $id): View
    {
        $data = $this->getOrderById($id);
        return view('admin.viewOrder', $data);
    }

    /**
     * Назначение исполнителя
     * 
     * @param int $orderId Номер заявки
     * @param int $userId Исполнитель
     * @return JsonResponse назначен ли исполнитель
     */
    public function setExecutorRequest(int $orderId, int $userId): JsonResponse
    {
        $result = $this->assignExecutorToOrder($orderId, $userId);
        return response()->json($result);
    }

    /**
     * Убрать исполнителя из заявки
     * 
     * @param int $orderId Номер заказа
     * @param int $userId Id юзера
     * @return JsonResponse Json-ответ, удалена ли запись
     */
    public function revokeExecutorOrderRequest(int $orderId, int $userId): JsonResponse
    {
        $result = $this->revokeUserFromOrder($orderId, $userId);
        return response()->json($result);
    }

    /**
     * Создание страницы с созданием пользователя
     */
    public function createUserRequest(): View
    {
        return view('admin.createUser');
    }

    /**
     * POST-запрос на создание пользователя
     * 
     * @param CreateUserRequest $request Запрос на создание пользователя
     */
    public function postUserRequest(CreateUserRequest $request)
    {
        if ($request->validated()) {
            $result = $this->postUser($request);
            $result ? Session::flash('success', 'Пользователь успешно добавлен') : Session::flash('error', 'Добавить пользователя не удалось');
            return redirect()->route('admin.index');
        }
        return redirect()->back();
    }

    /**
     * Удаление пользователя
     */
    public function deleteUserRequest(int $id)
    {
        $deleteResult = $this->deleteUser($id);
        $deleteResult ? Session::flash('success', 'Пользователь успешно удален') : Session::flash('error', 'Удалить пользователя не удалось');
        return redirect()->route('admin.index');
    }
}
