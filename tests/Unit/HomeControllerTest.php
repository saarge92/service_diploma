<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;
use App\Cart;

/**
 * Класс для unit-тестирования HomeController
 *
 * @author Inara Durdyeva <inara97_97@mail.ru>
 * @copyright Copyright (c) Inara Durdyeva
 */
class HomeControllerTest extends TestCase
{
    /**
     * Тестирование index метода
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200)->assertViewHasAll([
            'about', 'aboutFeatures', 'sliders', 'services'
        ]);
    }

    /**
     * Тестирование добавления элемента в корзину
     */
    public function testAddToCart()
    {
        $postData = ['serviceId' => 3];
        $response = $this->post('/add-to-cart', $postData);
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonStructure(['count']);
    }

    /**
     * Тестирование удаления услуги из корзины
     */
    public function testReduceItem()
    {
        Session::start();
        $response = $this->json('POST', '/reduceByOne', ['orderId' => 2, '_token' => csrf_token()], ['Content-Type' => 'application/json']);
        $response->assertStatus(200);
    }
}
