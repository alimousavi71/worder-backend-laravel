<?php

namespace App\Enums\Database\User;

use BenSampo\Enum\Enum;

/**
 * @method static static Website()
 * @method static static Linkedin()
 * @method static static Instagram()
 * @method static static Direct()
 * @method static static Google()
 */
final class UserKnowUs extends Enum
{
    const Website = 1;
    const Linkedin = 2;
    const Instagram = 3;
    const Direct = 4;
    const Google = 5;
    const Facebook = 6;
}
