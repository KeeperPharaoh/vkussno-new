<?php

namespace App\Domain\Contracts;

interface SliderContract
{
    public const TABLE = 'sliders';

    public const IMAGE     = 'image';
    public const TITLE     = 'title';
    public const SUBTITLE  = 'subtitle';
    public const PRICE     = 'price';
    public const OLD_PRICE = 'old_price';

}
