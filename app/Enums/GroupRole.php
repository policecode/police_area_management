<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GroupRole extends Enum
{
    const ADMIN =   ['id' => 1, 'name' => 'Admin', 'slug' => 'admin'];
    const AUTHOR =   ['id' => 2, 'name' => 'Author', 'slug' => 'author'];
    const READER =   ['id' => 3, 'name' => 'Reader', 'slug' => 'reader'];

}
