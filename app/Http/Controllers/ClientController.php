<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\View\View;
use App\Traits\ClientTrait;
use Illuminate\Http\Request;
use App\Interfaces\ICartService;
use App\Interfaces\IOrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ChangeProfileRequest;
use App\Interfaces\IUserProfileService;

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
    use ClientTrait;

    private ICartService $cartService;
    private IOrderService $orderService;
    private IUserProfileService $userProfileService;

    public function __construct(ICartService $cartService, IOrderService $orderService, IUserProfileService $userProfileService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->userProfileService = $userProfileService;
    }

    /**
     * Получение данных корзины
     *
     * @return View - возвращает страницу с данными корзины
     */
    public function getCartInfoClient(): View
    {
        if (!Session::has('cart')) {
            return \redirect('/#services');
        }
        $cartInfo = $this->cartService->getCartInfo();
        return view('client.shoppingCartView', $cartInfo);
    }

    /**
     * Генерация индексной страницы клиента
     *
     * @param Request $request - Get-запрос
     * @return View Возвращает индексную страницу
     */
    public function index(Request $request): View
    {
        $data = $this->getDataForClientIndex($request);
        return view('client.index', $data);
    }

    /**
     * Генерация страницы профиля
     *
     * @param Request $request - Get запрос
     * @return View Страница с информацией о профиле
     */
    public function profile(Request $request): View
    {
        $user = $request->user();
        $profile = ['user' => $user];
        return view('client.profile', $profile);
    }

    /**
     * Запрос на изменение профиля
     * @param ChangeProfileRequest $request Параметры изменения параметров пользователя
     * @return RedirectResponse Перенаправление на страницу клиентского профиля
     */
    public function changeProfile(ChangeProfileRequest $request)
    {
        if ($request->validated()) {
            $currentUserId = $request->user()->id();
            $editParams = $request->all();
            $result = $this->userProfileService->changeUserInfo($currentUserId, $editParams);
            $result ? Session::flash('success-client', 'Ваш профиль успешно обновлен')
                : Session::flash('error-client', 'Профиль обновить не удалось');
            return redirect()->route('client.profile');
        }
        return redirect()->back();
    }

    /**
     * Подтверждение заказа
     *
     * @param Request $request - Post-запрос
     * @return RedirectResponse Перенаправление в случае успеха на страницу клиента
     */
    public function confirmOrder(Request $request): RedirectResponse
    {
        if (!Session::has('cart')) {
            return redirect()->route('frontend.getShoppingCart');
        }
        $cart = new Cart(Session::get('cart'));
        $currentUserId = $request->user()->id;
        $result = $this->orderService->confirmOrderCheck($cart, $currentUserId);
        Session::remove('cart');
        $result ? Session::flash('success-client', 'Заказ успешно зарегистрирован')
            : Session::flash('error-client', 'Что-то пошло не так. Обратитесь к администратору');
        return redirect()->route('client.index');
    }

    /**
     * Получение заказа по номеру
     *
     * @param Request $request - Get-запрос
     * @param int $id - номер заказа
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function getOrder(Request $request, int $id)
    {
        $order = $this->orderService->getOrderById($id);
        return view('client.order', ['order' => $order]);
    }
}
