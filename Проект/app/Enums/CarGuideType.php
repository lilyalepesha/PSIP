<?php

namespace App\Enums;

use App\Traits\Enum\EnumTrait;

enum CarGuideType: int
{
    use EnumTrait;

    case GUIDE = 1;
    case GUIDE_LIST = 2;
}
