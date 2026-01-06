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
    const UNKNOWN =   ['key' => 3, 'value' => 'Không xác định'];

    public static function getValueByKey($key)
    {
        foreach (self::getValues() as $gender) {
            if ($gender['key'] == $key) {
                return $gender['value'];
            }
        }
    }
}
