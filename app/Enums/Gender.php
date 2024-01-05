<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Gender extends Enum
{
    const MALE =   ['key' => 1, 'value' => 'Nam'];
    const FEMALE =   ['key' => 2, 'value' => 'Nữ'];
    const UNKNOƯN =   ['key' => 3, 'value' => 'Không xác định'];

}
