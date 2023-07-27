<?php

namespace App\Enums\Database\Contact;

use BenSampo\Enum\Enum;


final class Rate extends Enum
{
    const EXCELLENT = 1;
    const GOOD = 2;
    const NORMAL = 3;
    const BAD = 4;
    const VERY_BAD = 5;
}
