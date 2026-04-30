<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MoneyToCoint extends Enum
{
    // Xử lý trạng thái khóa truyện
    const OPTION_1 =   ['key' => 1, 'value' => 2000, 'display' => '2.000 LT', 'money' => 20000];
    const OPTION_2 =   ['key' => 2, 'value' => 5000, 'display' => '5.000 LT', 'money' => 50000];
    const OPTION_3 =   ['key' => 3, 'value' => 10000, 'display' => '10.000 LT', 'money' => 100000];
    const OPTION_4 =   ['key' => 4, 'value' => 20400, 'display' => '20.400 LT (+2%)', 'money' => 200000];
    const OPTION_5 =   ['key' => 5, 'value' => 52000, 'display' => '52.000 LT (+4%)', 'money' => 500000];
    const OPTION_6 =   ['key' => 6, 'value' => 106000, 'display' => '106.000 LT (+6%)', 'money' => 1000000];


    public static function getItemByKey($key)
    {
        foreach (self::getValues() as $item) {
            if ($item['key'] == $key) {
                return $item;
            }
        }
        return null;
    }

    public static function getItemByMoney($money)
    {
        foreach (self::getValues() as $item) {
            if ($item['money'] == $money) {
                return $item;
            }
        }
        return null;
    }
}
