<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Interfaces\IContactService;
use App\Traits\HomeTrait;
use App\Interfaces\IService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ContactRequest;
use App\Interfaces\ICartService;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

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

    private IService $serviceImpl;
    private ICartService $cartService;
    private IContactService $contactService;

    public function __construct(IService $serviceImpl, ICartService $cartService, IContactService $contactService)
    {
        $this->serviceImpl = $serviceImpl;
        $this->cartService = $cartService;
        $this->contactService = $contactService;
    }

    /**
     * Индексная страница
     */
    public function index()
    {
        $data = $this->getDataForIndexPage();
        return view('frontend.index', $data);
    }

    /**
     * Получает список услуг
     *
     * @return View
     */
    public function getListServices(): View
    {
        $services = $this->serviceImpl->getServices();
        return view('client.services', ['services' => $services]);
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
        $cart = $this->cartService->addCartToItem((int)$id);
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
        $cartInfo = $this->cartService->getCartInfo();
        return view('frontend.shoppingCartView', $cartInfo);
    }

    /**
     * Уменьшение на 1 позицию в корзине
     * @param Request $request Запрос с параметром заказа
     * @return JsonResponse Ответ в формате json об успешном исполнении запроса
     */
    public function reduceItemRequest(Request $request): JsonResponse
    {
        $id = $request['orderId'];
        $results = $this->cartService->reduceItem((int)$id);
        return response()->json(['updated_results' => $results], 200);
    }

    /**
     * Увеличение на 1 позицию в корзине
     * @param Request $request Запрос с параметром заказа
     * @return JsonResponse
     */
    public function increaseItemRequest(Request $request): JsonResponse
    {
        $id = $request['orderId'];
        $updated_results = $this->cartService->increaseItem((int)$id);
        return response()->json(['updated_results' => $updated_results], 200);
    }

    /**
     * Удаление услуги полностью
     *
     * @param Request $request - post запрос на удаление услуги из списка
     * @return  JsonResponse Ответ об удалении в JSON-формате
     */
    public function deleteItemRequest(Request $request): JsonResponse
    {
        $id = $request['orderId'];
        $results = $this->cartService->deleteItem($id);
        return response()->json(['updated_results' => $results], 200);
    }

    /**
     * Добавление заявки на обратный звонок в базу
     * @param ContactRequest $request Запрос с параметрами для связи
     * @return JsonResponse Добавлена ли запись или нет
     */
    public function contactRequest(ContactRequest $request): JsonResponse
    {
        $result = false;
        if ($request->validated()) {
            $result = $this->contactService->addContactMe($request->all());
        }
        return response()->json($result);
    }
}
