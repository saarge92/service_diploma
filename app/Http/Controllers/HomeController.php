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

    /**
     * Индексная страница
     */
    public function index(): View
    {
        $data = $this->getDataForIndexPage();
        return view('frontend.index', $data);
    }

    /**
     * Получает список услуг
     * 
     * @param Request $request - Get-запрос
     */
    public function getListServices(Request $request): View
    {
        $services = $this->getServices($request);
        return view('client.services', $services);
    }

    /**
     * Метод для добавления услуги в корзину
     * 
     * @param Request $request - запрос
     * @return JsonResponse - возвращает JSON с общим количеством услуг в корзине
     */
    public function addToCart(Request $request): JsonResponse
    {
        $id = $request['serviceId'];
        $cart = $this->addToCartItem($id);
        $request->session()->put('cart', $cart);
        return response()->json(['count' => $cart->totalQty]);
    }

    /**
     * Получение списка услуг в корзине
     * 
     * @return View возвращает страницу со списком заказанных услуг
     */
    public function getShoppingCart(): View
    {
        if (!Session::has('cart')) {
            return view('frontend.shoppingCartView');
        }
        $cartInfo = $this->getCartInfo();
        return view('frontend.shoppingCartView', $cartInfo);
    }

    /**
     * Уменьшение на 1 позицию в корзине
     */
    public function reduceItemRequest(Request $request): JsonResponse
    {
        $id = $request['orderId'];
        $results = $this->reduceItem($id);
        return response()->json(['updated_results' => $results], 200);
    }

    /**
     * Увеличение на 1 позицию в корзине
     */
    public function increaseItemRequest(Request $request): JsonResponse
    {
        $id = $request['orderId'];
        $updated_results = $this->increaseItem($id);
        return response()->json(['updated_results' => $updated_results], 200);
    }

    /**
     * Удаление услуги полностью
     * @param Request $request - post запрос на удаление услуги из списка
     */
    public function deleteItemRequest(Request $request): JsonResponse
    {
        $id = $request['orderId'];
        $results = $this->deleteItem($id);
        return response()->json(['updated_results' => $results], 200);
    }
}
