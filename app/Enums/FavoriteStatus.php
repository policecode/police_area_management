<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FavoriteStatus extends Enum
{
    const LIKE =   ['id' => 1, 'name' => 'Yêu thích', 'slug' => 'like'];
    const NOTINTERESTED =   ['id' => 2, 'name' => 'Không quan tâm', 'slug' => 'not-interested'];
    const DISLIKE =   ['id' => 3, 'name' => 'Không thích', 'slug' => 'dislike'];


}
