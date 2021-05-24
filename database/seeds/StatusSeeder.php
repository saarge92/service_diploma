<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    private array $statusDictionary = [
        1 => 'Новая',
        2 => 'В работе',
        3 => 'В ожидании'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->statusDictionary as $id => $name) {
            $status = Status::find($id);
            if (!$status) {
                Status::create(['name' => $name, 'id' => $id]);
            }
        }
    }
}
