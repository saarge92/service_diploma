<?php

namespace App\Traits;

use App\Slider;
use App\About;
use App\Service;
use App\Cart;
use App\Team;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ContactRequest;
use App\ContactRequestTable;

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
    public function getDataForIndexPage(): array
    {
        $sliders = Slider::where(['is_on_main' => true])->get();
        $abouts = About::all()->first();
        $abouts ? $aboutFeatures = explode('|', $abouts->description) : $aboutFeatures = ['Автоматизация бизнеса', 'Интеграция торговых платформ'];
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

}
