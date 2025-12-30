<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ReportChapterStatus extends Enum
{
    const WAITING =   ['id' => 1, 'name' => 'Chờ xử lý', 'slug' => 'waiting'];
    const SUCCESS =   ['id' => 2, 'name' => 'Đã xử lý', 'slug' => 'success'];
    const REPEAT =   ['id' => 3, 'name' => 'Báo lỗi lại', 'slug' => 'repeat'];

     public static function getByKey($key) {
        $arrayClass = ReportChapterStatus::asArray();
        foreach ($arrayClass as $item) {
            if ($item['key'] == $key) {
                return $item;
            }
        }
    }
}
