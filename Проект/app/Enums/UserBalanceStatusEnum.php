<?php

namespace App\Enums;

use App\Traits\Enum\EnumTrait;

enum UserBalanceStatusEnum: int
{
    use EnumTrait;

    case SUCCESS = 1;
    case ERROR = 2;
    case CANCEL = 3;

    /**
     * @return string
     */
    public function title(): string
    {
        return match ($this) {
            self::SUCCESS => 'Успех',
            self::ERROR => 'Ошибка',
            self::CANCEL => 'Отменен'
        };
    }
}
