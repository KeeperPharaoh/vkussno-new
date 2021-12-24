<?php

namespace App\Domain\Contracts;

interface PaymentTypeContract
{
    public const TABLE = "payment_types";

    public const TYPE  = "type";
    public const IMAGE = "image";
}
