<?php

namespace App\Enums;

use App\Traits\Enum\EnumTrait;
use Illuminate\Support\Str;

enum RoleEnum: int
{
    use EnumTrait;

    case SCRAPING = 1;
    case USER_NOT_ACCEPTED = 2;
    case USER_ACCEPTED = 3;
    case ADMINISTRATOR = 4;
    case DEVELOPER = 5;

    /**
     * @return string
     */
    public function title(): string
    {
        return match ($this) {
            self::SCRAPING => 'SCRAPING',
            self::USER_NOT_ACCEPTED => 'Пользователь (не подтв.)',
            self::USER_ACCEPTED => 'Пользователь',
            self::ADMINISTRATOR => 'Администратор',
            self::DEVELOPER => 'Разработчик',
        };
    }

    /**
     * @return string
     */
    public function slug(): string
    {
        return Str::lower($this->name);
    }
}
