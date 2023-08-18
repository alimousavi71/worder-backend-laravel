<?php

namespace App\Enums\Database\Exam;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class ExamType extends Enum implements LocalizedEnum
{
    const Normal = 1;

    const Timer = 2;
}
