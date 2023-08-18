<?php


use App\Enums\Database\Exam\ExamType;

return [
    ExamType::class => [
        ExamType::Random => 'تصادفی',
        ExamType::HardWord => 'کلمات سخت',
        ExamType::MyWord => 'کلمات خودم',
        ExamType::Speed => 'سرعتی',
        ExamType::SpeedAndAccuracy => 'سرعت و دقت',
    ],
];
