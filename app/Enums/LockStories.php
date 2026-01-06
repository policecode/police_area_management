<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class LockStories extends Enum
{
    // Xử lý trạng thái khóa truyện
    const LOCK =   ['key' => 1, 'value' => 'Mở'];
    const UNLOCK =   ['key' => 2, 'value' => 'Khóa'];
}
