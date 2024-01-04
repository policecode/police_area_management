<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Business extends Enum
{
    const HOTEL =   ['value' => 1, 'display' => 'Lưu trú ngắn hạn'];
    const HOUSE =   ['value' => 2, 'display' => 'Nhà cho thuê'];
    const TRAVEL =   ['value' => 3, 'display' => 'Du lịch'];

}
