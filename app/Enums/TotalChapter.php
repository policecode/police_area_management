<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TotalChapter extends Enum
{
    const OPTION1 =   ['key' => '0-100', 'value' => 'Dưới 100 chương', 'min' => null, 'max' => 100];
    const OPTION2 =   ['key' => '100-500', 'value' => '100 - 500 chương', 'min' => 100, 'max' => 500 ];
    const OPTION3=   ['key' => '500-1000', 'value' => '500 - 1000 chương', 'min' => 500, 'max' => 1000 ];
    const OPTION4=   ['key' => '1000-max', 'value' => 'Trên 1000 chương', 'min' => 1000, 'max' => null ];

    public static function getTotalChapterByKey($key) {
        $totalChapter = TotalChapter::asArray();
        foreach ($totalChapter as $item) {
            if ($item['key'] == $key) {
                return $item;
            }
        }
    }
}
