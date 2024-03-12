<?php

namespace App\Enums;

use App\Traits\Enum\EnumTrait;

enum UserTypeEnum: int
{
    use EnumTrait;

    case USER = 1;
    case ORGANIZATION = 2;

    /**
     * @return string
     */
    public function title(): string
    {
        return match ($this) {
            self::USER => 'Пользователь',
            self::ORGANIZATION => 'Организация',
        };
    }
}
