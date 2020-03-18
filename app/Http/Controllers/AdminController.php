<?php

namespace App\Http\Controllers;

use App\Interfaces\IContactService;
use App\Interfaces\IExecutorService;
use App\Interfaces\IRequestOrderService;
use App\Interfaces\IRoleService;
use App\Interfaces\IUserService;
use Illuminate\Http\Request;
use App\Traits\AdminTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Session;
use App\Role;
use Illuminate\View\View;

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

    private IRoleService $roleService;
    private IExecutorService $executorService;

    public function __construct(IRoleService $roleService, IExecutorService $executorService)
    {
        $this->roleService = $roleService;
        $this->executorService = $executorService;
    }

    /**
     * Генерация индексной страницы пользователя
     *
     * @param Request $request - Get-запрос
     * @param IUserService $userService Внедрение зависимостей
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index(Request $request, IUserService $userService)
    {
        $request->has('roleId') ? $users = $userService->getUsersByRoleId($request->get('roleId')) :
            $users = $userService->getAllUsers();
        $roles = $this->roleService->getAll();
        return view('admin.index', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    /**
     * Отображение списка всех заявок
     *
     * @param Request $request Get Запрос
     * @param IRequestOrderService $requestOrderService Внедрение зависимости функционала
     * по работе с заявками пользователей
     * @return View Отображает страницу со списком всех заказов
     */
    public function viewRequests(Request $request, IRequestOrderService $requestOrderService)
    {
        $data = $requestOrderService->getAllRequests($request->all());
        return view('admin.allOrders', $data);
    }

    /**
     * Генерация конкретного заказа
     * @param int $id Номер услуги
     * @param IRequestOrderService $requestOrderService Внедрение зависимости функционала
     * по работе с заявками пользователей
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function viewOrder(int $id, IRequestOrderService $requestOrderService)
    {
        $data = $requestOrderService->getOrderById($id);
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
        $result = $this->executorService->assignExecutorToOrder($orderId, $userId);
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
        $result = $this->executorService->revokeUserFromOrder($orderId, $userId);
        return response()->json($result);
    }

    /**
     * Создание страницы с созданием пользователя
     */
    public function createUserRequest()
    {
        $roles = Role::all();
        return view('admin.createUser', compact('roles'));
    }

    /**
     * POST-запрос на создание пользователя
     *
     * @param CreateUserRequest $request Запрос на создание пользователя
     * @param IUserService $userService Сервис по работе с пользователями
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUserRequest(CreateUserRequest $request, IUserService $userService)
    {
        if ($request->validated()) {
            $result = $userService->postCreateUser($request->all());
            $result ? Session::flash('success', 'Пользователь успешно добавлен') : Session::flash('error', 'Добавить пользователя не удалось');
            return redirect()->route('admin.index');
        }
        return redirect()->back();
    }

    /**
     * Удаление пользователя
     *
     * @param int $id Номер пользователя
     * @param IUserService $userService Сервис по работе с пользователями
     * @return JsonResponse Ответ в формате json об удаленном пользователе
     */
    public function deleteUserRequest(int $id, IUserService $userService): JsonResponse
    {
        $deleteResult = $userService->deleteUser($id);
        return response()->json($deleteResult);
    }

    /**
     * Post-запрос на удаление комментария
     *
     * @param int $commentId Номер комментария
     * @return JsonResponse Json ответ об успешном удалении комментария
     */
    public function deleteCommentRequest(int $commentId): JsonResponse
    {
        $result = $this->deleteComment($commentId);
        return response()->json($result);
    }

    /**
     * Получение информации и пользователе
     *
     * @param int $userId Id пользователя
     * @param IUserService $userService Сервис по работе с пользователями
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function getUserInfoRequest(int $userId, IUserService $userService)
    {
        $data = $userService->getUserInfo($userId);
        return view('admin.userInfo', $data);
    }

    /**
     * Добавление роли для пользователя
     * @param int $userId Id пользователя
     * @param int $roleId Номер роли
     * @return JsonResponse Результат дарования роли пользователю
     */
    public function grantRoleToUserRequest(int $userId, int $roleId): JsonResponse
    {
        $resultCreation = $this->roleService->grantRoleToUser($userId, $roleId);
        return response()->json($resultCreation);
    }

    /**
     * Удаление роли для пользователя
     * @param int $userId Id пользователя
     * @param int $roleId Номер роли
     * @return JsonResponse Результат дарования роли пользователю
     */
    public function revokeRoleRequest(int $userId, int $roleId): JsonResponse
    {
        $result = $this->roleService->revokeRole($userId, $roleId);
        return response()->json($result);
    }

    /**
     * Удаление заявки по его id
     * @param int $id
     * @param IRequestOrderService $requestOrderService Зависимость по работе с заказами
     * @return JsonResponse
     */
    public function deleteRequest(int $id, IRequestOrderService $requestOrderService): JsonResponse
    {
        $result = $requestOrderService->deleteRequestById($id);
        return response()->json($result);
    }

    /**
     * GET-запрос на отоборажение списка
     * @param IContactService $contactService Сервис по работе с заявками на
     * обратную связь
     * @return View - Страница со списком
     */
    public function displayContacts(IContactService $contactService)
    {
        $contactRecords = $contactService->getRecordsOfContacts();
        return view('admin.contacts', $contactRecords);
    }

    /**
     * POST-запрос на удаление записи об обратном звонке
     * @param int $id Id записи
     * @return JsonResponse Удалена ли запись
     */
    public function deleteContactInfo(int $id, IContactService $contactService): JsonResponse
    {
        $resultOperation = $contactService->deleteRecordContactInfo($id);
        return response()->json($resultOperation);
    }
}
