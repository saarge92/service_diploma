<?php
namespace App\Traits;

use App\Slider;
use App\About;
use App\Service;
use App\Cart;
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
        $data = array(
            'sliders' => $sliders,
            'about' => $abouts,
            'aboutFeatures' => $aboutFeatures,
            'services' => $services
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
}