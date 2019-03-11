<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ExecutorTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PostCommentRequest;

/**
 * Контроллер для работы со страницей исполнителя
 * 
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class ExecutorController extends Controller
{
    use ExecutorTrait;

    /**
     * Генерация индексной страницы исполнителя
     * 
     * @param Request $request Get-запрос
     */
    public function index(Request $request)
    {
        $data = $this->getExecutorOrders($request);
        return view('executor.index', $data);
    }

    /**
     * Получение информации о заявки с комментариями
     * 
     * @param int $id Номер услуги
     */
    public function getOrder(int $id)
    {
        $data = $this->getOrderById($id);
        return view('executor.viewOrder', $data);
    }

    /**
     * Отправка комментария исполнителем
     */
    public function submitComment(PostCommentRequest $request): JsonResponse
    {
        $resultCreation = $this->postComment($request);
        return \response()->json([
            $resultCreation
        ]);
    }
}
