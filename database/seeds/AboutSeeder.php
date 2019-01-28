<?php

use Illuminate\Database\Seeder;
use App\About;
class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        About::create([
            'title' => 'Мы IT компания, занимающаяся автоматизацией бизнеса',
            'content' => 'Мы предлагаем широкий спектр услуг в сфере бизнеса. Автоматизируем задачи в сфере торговли и маркетинга.
            В перечень наших задач входит : ',
            'path' => 'about/1c_bussines.png',
            'description' => 'Автоматизация торговли, Поддержка систем продажи, Интеграция 1с платформ'
        ]);
    }
}
