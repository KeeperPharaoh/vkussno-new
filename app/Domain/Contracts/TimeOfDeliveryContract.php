<?php

namespace App\Domain\Contracts;

interface TimeOfDeliveryContract
{
    public const TABLE = 'time_of_deliveries';

    public const BEGINNING_TIME  = 'beginning_time';
    public const END_TIME        = 'end_time';
    public const COUNTER         = 'counter';
    public const MAX_COUNTER     = 'max_counter';
    public const BLOCK           = 'block';
}
