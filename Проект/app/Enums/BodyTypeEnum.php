<?php

namespace App\Enums;

use App\Traits\Enum\EnumTrait;

enum BodyTypeEnum: int
{
    use EnumTrait;

    case VNEDOROZNIK_3_DV = 1;
    case VNEDOROZNIK_5_DV = 2;
    case KABRIOLET = 3;
    case KUPE = 4;
    case LEGKOVOI_FURGON = 5;
    case LIMUZIN = 6;
    case LIFTBEK = 7;
    case MIKROAVTOBUS_GRUZOPASSAZIRSKII = 8;
    case MIKROAVTOBUS_PASSAZIRSKII = 9;
    case MINIVEN = 10;
    case PIKAP = 11;
    case RODSTER = 12;
    case SEDAN = 13;
    case UNIVERSAL = 14;
    case XETCBEK_3_DV = 15;
    case XETCBEK_5_DV = 16;
    case DRUGOI = 17;

    /**
     * @return string
     */
    public function title(): string
    {
        return match ($this) {
            self::VNEDOROZNIK_3_DV => "внедорожник 3 дв.",
            self::VNEDOROZNIK_5_DV => "внедорожник 5 дв.",
            self::KABRIOLET => "кабриолет",
            self::KUPE => "купе",
            self::LEGKOVOI_FURGON => "легковой фургон",
            self::LIMUZIN => "лимузин",
            self::LIFTBEK => "лифтбек",
            self::MIKROAVTOBUS_GRUZOPASSAZIRSKII => "микроавтобус грузопассажирский",
            self::MIKROAVTOBUS_PASSAZIRSKII => "микроавтобус пассажирский",
            self::MINIVEN => "минивэн",
            self::PIKAP => "пикап",
            self::RODSTER => "родстер",
            self::SEDAN => "седан",
            self::UNIVERSAL => "универсал",
            self::XETCBEK_3_DV => "хэтчбек 3 дв.",
            self::XETCBEK_5_DV => "хэтчбек 5 дв.",
            self::DRUGOI => "другой",
        };
    }
}
