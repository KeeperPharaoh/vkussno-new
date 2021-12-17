<?php

namespace App\Domain\Contracts;

interface FavoriteContract
{
    public const TABLE   = 'favorites';

    public const USER_ID     = 'user_id';
    public const PRODUCT_ID = 'product_id';
}
