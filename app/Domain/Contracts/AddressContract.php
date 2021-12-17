<?php

namespace App\Domain\Contracts;

interface AddressContract
{
    public const TABLE = 'addresses';

    public const USER_ID   = 'user_id';
    public const ADDRESS   = 'addresses';
    public const ENTRANCE  = 'entrance';
    public const FLOOR     = 'floor';
    public const APARTMENT = 'apartment';
}
