<?php

namespace App\Http\Controllers;

use App\Traits\HomeTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Контроллер обработки запросов авторизованных клиентов
 * 
 * Содержит методы для генерации страниц в личном кабинете клиента
 * 
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class ClientController extends Controller
{
    /**
     * Получение данных корзины
     * 
     * @return View - возвращает страницу
     */
    public function getCartInfo() : View
    {
        if (!Session::has('cart')) {
            return \redirect('/#services');
        }
        $cartInfo = $this->getCartInfo();
        return view('client.shoppingCartView', $cartInfo);
    }

    public function index(Request $request)
    {
        return view('client.index');
    }
}
