<?php

namespace App\Enums;

use App\Traits\Enum\EnumTrait;

enum TypeOfSpaceEnum: int
{
    use EnumTrait;

    case TRANSACTION = 1;

    /**
     * @return string
     */
    public function title(): string
    {
        return match ($this) {
            self::TRANSACTION => 'Транзакции'
        };
    }
}
