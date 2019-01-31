<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create(
            [
                'name' => 'Инара Дурдыева',
                'photo' => 'team/inara.png',
                'position' => 'Разработчик',
                'vk_url' => 'https://vk.com/id221758644'
            ]
        )->save();
    }
}
