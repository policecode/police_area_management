<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProposeStatus extends Enum
{
    const DROP =   ['key' => 1, 'value' => 'Không đề xuất'];
    const PROPOSE =   ['key' => 2, 'value' => 'Đề xuất'];

    public static function getValueByKey($key)
    {
        foreach (self::getValues() as $gender) {
            if ($gender['key'] == $key) {
                return $gender['value'];
            }
        }
    }
}
