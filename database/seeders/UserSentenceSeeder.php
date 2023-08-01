<?php

namespace Database\Seeders;

use App\Models\UserSentence;
use Illuminate\Database\Seeder;

class UserSentenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSentence::factory(20)->create();
    }
}
