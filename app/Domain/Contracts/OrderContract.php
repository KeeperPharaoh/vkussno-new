<?php

namespace App\Domain\Contracts;

interface OrderContract
{
    public const TABLE = 'orders';

    public const PRODUCT_ID = 'product_id';
    public const CART_ID    = 'cart_id';
    public const QUANTITY   = 'quantity';
}
