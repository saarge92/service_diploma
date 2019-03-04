<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AdminTrait;
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

    /**
     * Генерация индексной страницы пользователя
     * 
     * @param Request $request - Get-запрос
     */
    public function index(Request $request): View
    {
        $data = $this->getAllUsers($request);
        return view('admin.index', $data);
    }

    public function viewRequests(Request $request): View
    {
        $data = $this->getAllRequests($request);
        return view('admin.allRequests', $data);
    }
}
