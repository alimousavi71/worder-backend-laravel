<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\UserWord;
use App\Models\WordExam;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            SentenceSeeder::class,
            WordSeeder::class,
            ContactSeeder::class,
            UserWordSeeder::class,
            LoginSeeder::class,
            ExamSeeder::class,
            WordExamSeeder::class,
            UserSentenceSeeder::class,
        ]);
    }
}
