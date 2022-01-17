<?php

namespace App\Domain\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface FavoriteContract extends RepositoryInterface
{
    public const TABLE   = 'favorites';

    public const USER_ID     = 'user_id';
    public const PRODUCT_ID = 'product_id';
}
