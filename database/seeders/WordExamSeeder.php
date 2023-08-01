<?php

namespace Database\Seeders;

use App\Models\WordExam;
use Illuminate\Database\Seeder;

class WordExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WordExam::factory(100)->create();
    }
}
