<?php

namespace App\Enums\Database\Sentence;

use BenSampo\Enum\Enum;

final class SentenceStatus extends Enum
{
    const Publish = 1;
    const Pending = 2;
}
