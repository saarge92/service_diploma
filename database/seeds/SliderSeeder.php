<?php

use Illuminate\Database\Seeder;
use App\Slider;
class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Slider::create([
            'path' => 'sliders/slider1.png',
            'title' => 'Лучший сервис-услуги в 1с',
            'content' => 'Предлагаем широкий спектр услуг в it-сфере'
        ])->save();
        Slider::create([
            'path' => 'sliders/slider2.png',
            'title' => 'Хиты продаж',
            'content' => 'Успешные предприниматели выбирают 1С! Успейти оформить заявку!'
        ])->save();
        Slider::create([
            'path' => 'sliders/slider3.png',
            'title' => 'Отраслевые решения',
            'content' => 'Широкий арсенал отраслевых решений только у нас!'
        ])->save();
    }
}
