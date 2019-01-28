<?php
namespace App\Traits;

use App\Slider;
use App\About;

/**
 * Трейт для работы с данными на главной странице (frontend)
 * 
 * Содержит методы, возвращающие необходимые данные 
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
    public function dataForIndexPage() : array
    {
        $sliders = Slider::where(['is_on_main' => true])->get();
        $abouts = About::all()->first();
        $abouts ? $aboutFeatures = explode(',', $abouts->description) :
            $aboutFeatures = ['Автоматизация бизнеса', 'Интеграция торговых платформ'];
        $data = array('sliders' => $sliders, 'about' => $abouts, 'aboutFeatures' => $aboutFeatures);
        return $data;
    }
}