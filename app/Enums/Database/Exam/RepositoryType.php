<?php

namespace App\Enums\Database\Exam;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class RepositoryType extends Enum implements LocalizedEnum
{
    const MyWord = 1;

    const Random = 2;

    const LowRepetition = 3;

    const Repetitive = 4;

    const Harder = 5;
}
