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
    const HOTEL =   ['key' => 1, 'value' => 'Lưu trú ngắn hạn'];
    const HOUSE =   ['key' => 2, 'value' => 'Nhà cho thuê'];
    const TRAVEL =   ['key' => 3, 'value' => 'Du lịch'];

}
