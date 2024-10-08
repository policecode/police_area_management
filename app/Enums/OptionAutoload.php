<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OptionAutoload extends Enum
{
    const NO =   ['key' => 1, 'value' => 'Không tự động tải các option này khi trang web'];
    const YES =   ['key' => 2, 'value' => 'Tự động load các option trong một lượt khi tải trang web'];
}
