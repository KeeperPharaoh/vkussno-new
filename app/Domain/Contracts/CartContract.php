<?php

namespace App\Domain\Contracts;

interface CartContract
{
    public const TABLE = "carts";

    public const USER      = 'user_id';
    public const SUM       = 'sum';
    public const STATUS    = 'status';

    public const PHONE     = 'phone';
    public const ADDRESS   = 'addresses';
    public const ENTRANCE  = 'entrance';
    public const FLOOR     = 'floor';
    public const APARTMENT = 'apartment';

    public const TIME      = 'time';
    public const COMMENT   = 'comment';
}
