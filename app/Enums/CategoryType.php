<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CategoryType extends Enum
{
    const CAT =   ['key' => 1, 'value' => 'Thể loại'];
    const WORD =   ['key' => 2, 'value' => 'Bối cảnh thế giới'];
    const CHARATER =   ['key' => 3, 'value' => 'Tính cách nhân vật chính'];
    const SECT =   ['key' => 4, 'value' => 'Lưu phái'];

    public static function getCategoryTypeByKey($key) {
        $totalChapter = CategoryType::asArray();
        foreach ($totalChapter as $item) {
            if ($item['key'] == $key) {
                return $item;
            }
        }
    }
}
