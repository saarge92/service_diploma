<?php

namespace App\Http\Controllers;

use App\Interfaces\ICommentService;
use App\Interfaces\IExecutorService;
use App\Interfaces\IOrderService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PostCommentRequest;
use App\Http\Requests\SetOrderStatusExecutor;
use Illuminate\View\View;

/**
 * Контроллер для работы со страницей исполнителя
 *
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class ExecutorController extends Controller
{
    private IExecutorService $executorService;
    private ICommentService $commentService;

    public function __construct(IExecutorService $executorService, ICommentService $commentService)
    {
        $this->executorService = $executorService;
        $this->commentService = $commentService;
    }

    /**
     * Генерация индексной страницы исполнителя
     *
     * @param Request $request Get-запрос
     * @return View Индексная страница исполнителя заявок
     */
    public function index(Request $request): View
    {
        $requestParams = $request->all();
        $requestParams['user'] = $request->user();
        $data = $this->executorService->getExecutorOrders($requestParams);
        return view('executor.index', $data);
    }

    /**
     * Получение информации о заявки с комментариями
     *
     * @param int $id Номер услуги
     * @return  View Страница с заказом
     */
    public function getOrder(int $id): View
    {
        $data = $this->executorService->getOrderById($id);
        return view('executor.viewOrder', $data);
    }

    /**
     * Отправка комментария исполнителем
     *
     * @param PostCommentRequest $request Post-запрос с комментарием
     * @return JsonResponse Ответ в формате JSON с результатами операции
     */
    public function submitComment(PostCommentRequest $request): JsonResponse
    {
        $commentParams = $request->all();
        $commentParams['user'] = $request->user();
        $resultCreation = $this->commentService->postComment($commentParams);
        return \response()->json([
            $resultCreation
        ]);
    }

    /**
     * Установка статуса исполнителем
     *
     * @param SetOrderStatusExecutor $request Post-запрос
     * @param IOrderService $orderService Зависимость по работе с
     * @return JsonResponse Ответ в формате JSON с результатами операции
     */
    public function setStatusOrderRequest(SetOrderStatusExecutor $request, IOrderService $orderService): JsonResponse
    {
        $resultCreation = false;
        if ($request->validated()) {
            $resultCreation = $orderService->setStatusOrder($request->all());
        }
        return response()->json($resultCreation);
    }
}
