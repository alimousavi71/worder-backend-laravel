<?php

namespace App\Enums\Database\Exam;

use BenSampo\Enum\Enum;

final class ExamType extends Enum
{
    const Random = 1;
    const HardWord = 2;
    const MyWord = 3;
    const Speed = 4;
    const SpeedAndAccuracy = 5;
}
