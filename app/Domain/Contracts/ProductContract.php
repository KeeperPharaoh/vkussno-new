<?php

namespace App\Domain\Contracts;

interface ProductContract
{

    public const TABLE   = 'products';

    public const SUBCATEGORY_ID = 'subcategory_id';
    public const TITLE          = 'title';
    public const IMAGE          = 'image';
    public const DESCRIPTION    = 'description';
    public const PRICE          = 'price';
    public const OLD_PRICE      = 'old_price';

}