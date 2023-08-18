<?php

namespace App\Enums\Database\WordReport;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class EWordReportReason extends Enum implements LocalizedEnum
{
    const WrongWord = 1;

    const WrongTranslate = 2;

    const Useless = 3;

    const WrongPronunciation = 4;
}
