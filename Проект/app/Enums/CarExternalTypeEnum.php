<?php

namespace App\Enums;

use App\Traits\Enum\EnumTrait;

enum CarExternalTypeEnum: int
{
    use EnumTrait;

    case AV = 1;
    case KUFAR = 2;

    /**
     * @return string
     */
    public function title(): string
    {
        return match ($this) {
            self::AV => 'av.by',
            self::KUFAR => 'kufar.by',
        };
    }
}
