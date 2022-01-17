<?php

namespace App\Domain\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface AddressContract extends RepositoryInterface
{
    public const TABLE = 'addresses';

    public const USER_ID   = 'user_id';
    public const ADDRESS   = 'addresses';
    public const ENTRANCE  = 'entrance';
    public const FLOOR     = 'floor';
    public const APARTMENT = 'apartment';
}
