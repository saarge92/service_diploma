<?php

namespace App\Http\Controllers;

use App\Traits\HomeTrait;
use App\Traits\ClientTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use App\Cart;
use Illuminate\Http\RedirectResponse;

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
    use HomeTrait;
    use ClientTrait;
    /**
     * Получение данных корзины
     * 
     * @return View - возвращает страницу с данными корзины
     */
    public function getCartInfo() : View
    {
        if (!Session::has('cart')) {
            return \redirect('/#services');
        }
        $cartInfo = $this->getCartInfo();
        return view('client.shoppingCartView', $cartInfo);
    }
    /**
     * Генерация индексной страницы клиента
     * 
     * @param Request $request - Get-запрос
     */
    public function index(Request $request) : View
    {
        $data = $this->getDataForClientIndex($request);
        return view('client.index', $data);
    }

    /**
     * Подтверждение заказа
     * 
     * @param Request $request - Post-запрос
     */
    public function confirmOrder(Request $request) : RedirectResponse
    {
        if (!Session::has('cart')) {
            return redirect()->route('frontend.getShoppingCart');
        }
        $cart = new Cart(Session::get('cart'));
        $result = $this->confirmOrderCheck($cart, $request);
        Session::remove('cart');
        $result ? Session::flash('success-client', 'Заказ успешно зарегистрирован')
            : Session::flash('error-client','Что-то пошло не так. Обратитесь к администратору');
        return redirect()->route('client.index');
    }

}
