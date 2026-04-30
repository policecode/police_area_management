<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PaymentTransactionStatus extends Enum
{
    const PENDING =   ['key' => 1, 'value' => 'PENDING', 'display' => 'Chờ xử lý'];
    const SUCCESS =   ['key' => 2, 'value' => 'SUCCESS', 'display' => 'Thành công'];
    const FAILED =   ['key' => 3, 'value' => 'FAILED', 'display' => 'Thất bại'];
    const CANCELED =   ['key' => 4, 'value' => 'CANCELED', 'display' => 'Đã hủy'];

    
    public static function getItemByKey($key)
    {
        foreach (self::getValues() as $item) {
            if ($item['key'] == $key) {
                return $item;
            }
        }
        return null;
    }
}
