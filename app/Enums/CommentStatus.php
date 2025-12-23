<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CommentStatus extends Enum
{
     const UNREAD =    ['key' => 1, 'value' => 'Chưa Xem', 'slug' => 'unread'];
    const READ =    ['key' => 2, 'value' => 'Đã Xem', 'slug' => 'read'];
    const SPAM =  ['key' => 3, 'value' => 'Spam', 'slug' => 'spam'];

    public static function getByKey($key) {
        $arrayClass = CommentStatus::asArray();
        foreach ($arrayClass as $item) {
            if ($item['key'] == $key) {
                return $item;
            }
        }
    }
}
