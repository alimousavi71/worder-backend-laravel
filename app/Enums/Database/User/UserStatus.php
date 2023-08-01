<?php

namespace App\Enums\Database\User;

use BenSampo\Enum\Enum;

final class UserStatus extends Enum
{
    const Access = 1;

    const Linkedin = 2;

    const Instagram = 3;

    const Direct = 4;

    const Google = 5;

    const Facebook = 6;
}
