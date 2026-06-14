<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AudioStatus extends Enum
{
    const PENDING =   ['key' => 1, 'value' => 'Đang tạo audio'];
    const SUCCESS =   ['key' => 2, 'value' => 'Đã có audio'];

    public static function getValueByKey($key)
    {
        foreach (self::getValues() as $item) {
            if ($item['key'] == $key) {
                return $item['value'];
            }
        }
    }
}
