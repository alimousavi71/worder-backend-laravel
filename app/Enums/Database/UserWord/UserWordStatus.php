<?php

namespace App\Enums\Database\UserWord;

use BenSampo\Enum\Enum;

final class UserWordStatus extends Enum
{
    const Learn = 1;

    const IKnow = 2;

    const Pass = 3;
}
