<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HomeTrait;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
/**
 * Контроллер для работы с главной страницей
 * 
 * Содержит методы для генерации страниц
 * 
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class HomeController extends Controller
{
    use HomeTrait;

    public function index() : View
    {
        $data = $this->getDataForIndexPage();
        return view('frontend.index', $data);
    }

    /**
     * Метод для добавления услуги в корзину
     * 
     * @param Request $request - запрос
     * @return JsonResponse - возвращает JSON с общим количеством услуг в корзине
     */
    public function addToCart(Request $request) : JsonResponse
    {
        $id = $request['serviceId'];
        $cart = $this->addToCartItem($id);
        $request->session()->put('cart', $cart);
        return response()->json(['count' => $cart->totalQty]);
    }

    /**
     * Получение списка услуг в корзине
     */
    public function getShoppingCart() : View
    {
        if (!Session::has('cart')) {
            return view('frontend.shoppingCartView');
        }
        $cartInfo = $this->getCartInfo();
        return view('frontend.shoppingCartView', $cartInfo);
    }
}
