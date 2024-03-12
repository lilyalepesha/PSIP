<?php

namespace App\Enums;

use App\Traits\Enum\EnumTrait;

enum TransactionStatusEnum: int
{
    use EnumTrait;

    case OPEN = 1;
    case CLOSE = 2;
    case CANCEL = 3;

    /**
     * @return string
     */
    public function title(): string
    {
        return match ($this) {
            self::OPEN => 'Открыт',
            self::CLOSE => 'Завершен',
            self::CANCEL => 'Отменен'
        };
    }
}
