<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusStory extends Enum
{
    const FULL =   ['key' => 1, 'value' => 'Full', 'slug' => 'full'];
    const COMMINGOUT =   ['key' => 2, 'value' => 'Đang ra', 'slug' => 'dang-ra' ];
}
