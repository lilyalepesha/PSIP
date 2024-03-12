<?php

namespace App\Enums;

use App\Traits\Enum\EnumTrait;

enum CarStatusEnum: int
{
    use EnumTrait;

    case PUBLISHED = 1;
    case SOLD = 2;
    case CANCELLED = 3;

    /**
     * @return string
     */
    public function title(): string
    {
        return match($this) {
            self::PUBLISHED => 'Опубликовано',
            self::SOLD => 'Продано',
            self::CANCELLED => 'Отменено',
        };
    }
}
