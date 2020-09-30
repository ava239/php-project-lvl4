<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TaskStatus::factory()->count(4)->state(
            new Sequence(
                ['name' => 'new'],
                ['name' => 'in_work'],
                ['name' => 'testing'],
                ['name' => 'finished'],
            )
        )->create();
    }
}
