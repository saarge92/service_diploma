<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ExecutorTrait;

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
}
