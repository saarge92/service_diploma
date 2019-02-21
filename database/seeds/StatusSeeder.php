<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'В работе'])->save();
        Status::create(['name' => 'В ожидании'])->save();
        Status::create(['name' => 'Закрыто'])->save();
    }
}
