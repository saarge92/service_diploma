<?php

namespace App\Http\Controllers;

use App\Interfaces\IExecutorService;
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

    public function __construct(IExecutorService $executorService)
    {
        $this->executorService = $executorService;
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
        $resultCreation = $this->postComment($request);
        return \response()->json([
            $resultCreation
        ]);
    }

    /**
     * Установка статуса исполнителем
     *
     * @param SetOrderStatusExecutor $request Post-запрос
     * @return JsonResponse Ответ в формате JSON с результатами операции
     */
    public function setStatusOrderRequest(SetOrderStatusExecutor $request): JsonResponse
    {
        $resultCreation = false;
        if ($request->validated()) {
            $resultCreation = $this->setStatusOrder($request);
        }
        return response()->json($resultCreation);
    }
}
