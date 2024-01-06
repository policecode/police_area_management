<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Service extends Enum
{
    const STAYING =   ['key' => 1, 'value' => 'Tạm trú'];
    const WORK =   ['key' => 2, 'value' => 'Làm việc'];
    const VISIT =   ['key' => 3, 'value' => 'Thăm thân'];
}
