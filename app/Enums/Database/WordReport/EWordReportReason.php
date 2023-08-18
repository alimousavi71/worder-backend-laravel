<?php

namespace App\Enums\Database\WordReport;

use BenSampo\Enum\Enum;

final class EReason extends Enum
{
    const WrongWord = 1;

    const WrongTranslate = 2;

    const Useless = 3;

    const WrongPronunciation = 4;
}
