<?php

namespace App\Domain\Contracts;

interface PromoCodeContract
{
    public const TABLE = "promo_codes";

    public const PROMO        = "promo";
    public const PERCENT      = "percent";
    public const FIRST_BONUS  = "first_bonus_product";
    public const SECOND_BONUS = "first_bonus_product";
}
