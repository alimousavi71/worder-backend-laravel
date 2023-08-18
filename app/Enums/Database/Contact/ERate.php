<?php

namespace App\Enums\Database\Contact;

use BenSampo\Enum\Enum;

final class Rate extends Enum
{
    const EXCELLENT = 5;

    const GOOD = 4;

    const NORMAL = 3;

    const BAD = 2;

    const VERY_BAD = 1;
}
