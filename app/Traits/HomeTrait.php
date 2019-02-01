<?php
namespace App\Traits;

use App\Slider;
use App\About;
use App\Service;
use App\Cart;
use App\Team;
use Illuminate\Support\Facades\Session;

/**
 * Трейт для работы с данными на главной странице (frontend)
 * 
 * Содержит методы, возвращающие необходимые данные для работы главной страницы
 * 
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
trait HomeTrait
{
    /**
     * Данные, необходимые для главной страницы
     * 
     * Возвращает список слайдеров, данные о компании и прочее
     * 
     * @return array $data - список необходимых данных для главной страницы
     */
    public function getDataForIndexPage() : array
    {
        $sliders = Slider::where(['is_on_main' => true])->get();
        $abouts = About::all()->first();
        $abouts ? $aboutFeatures = explode('|', $abouts->description) :
            $aboutFeatures = ['Автоматизация бизнеса', 'Интеграция торговых платформ'];
        $services = Service::all()->take(6);
        $teams = Team::all()->take(4);
        $data = array(
            'sliders' => $sliders,
            'about' => $abouts,
            'aboutFeatures' => $aboutFeatures,
            'services' => $services,
            'teams' => $teams
        );
        return $data;
    }

    /**
     * Функция для добавления услуги в корзину
     * 
     * @param $id - номер услуги
     */
    public function addToCartItem($id) : Cart
    {
        $service = Service::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        if ($service) {
            $cart = new Cart($oldCart);
            $cart->add($service, $service->id);
            return $cart;
        }
        return $oldCart;
    }

    /**
     * Получение информации о корзине
     */
    public function getCartInfo() : array
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $result = array(
            'orders' => $cart->items,
            'totalPrice' => $cart->totalPrice
        );
        return $result;
    }

    /**
     * Уменьшение 1 позиции в корзине
     * 
     * @param int $id Id услуги в корзине
     * @return array $newCartResult Возвращает параметры корзины
     */
    public function reduceItem(int $id) : array
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->reduceByOne($id);
        Session::put('cart', $newCart);
        $newCartResult = $this->getUpdatedResult($newCart, $id);
        return $newCartResult;
    }

    /**
     * Увеличение корзины на 1 позицию
     * @param int $id - номер услуги в корзине
     */
    public function increaseItem(int $id) : array
    {
        $oldcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldcart);
        $cart->increaseByOne($id);
        Session::put('cart', $cart);
        $updated_results = $this->getUpdatedResult($cart, $id);
        return $updated_results;
    }

    /**
     * Возвращает параметры карты
     */
    private function getUpdatedResult(Cart $cart, int $id) : array
    {
        $updated_results['count_of_element'] = isset($cart->items[$id]['qty']) ? $cart->items[$id]['qty'] : 0;
        $updated_results['price'] = isset($cart->items[$id]['price']) ? $cart->items[$id]['price'] : 0;
        $updated_results['totalQty'] = $cart->totalQty;
        $updated_results['totalPrice'] = $cart->totalPrice;
        return $updated_results;
    }
}