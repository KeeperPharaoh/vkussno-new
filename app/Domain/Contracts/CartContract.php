<?php

namespace App\Domain\Contracts;

interface CartContract
{
    public const TABLE = "carts";

    public const USER           = 'user_id';
    public const SUM            = 'sum';
    public const STATUS         = 'status';
    public const PHONE          = 'phone';
    public const CITY           = 'city';
    public const ADDRESS        = 'addresses';
    public const ENTRANCE       = 'entrance';
    public const FLOOR          = 'floor';
    public const APARTMENT      = 'apartment';
    public const TIME           = 'time';
    public const COMMENT        = 'comment';
    public const PAYMENT_TYPE   = "payment_type";
    public const PAYMENT_STATUS = "payment_status";
    public const ORDER_STATUS   = "order_status";
    public const DELIVERY_PRICE = 'delivery_price';
    public const BONUSES_SPEND  = 'bonuses_spend';
}
