<?php

namespace Database\Seeders;

use App\Models\UserWord;
use Illuminate\Database\Seeder;

class UserWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserWord::factory(200)->create();
    }
}
