<?php

namespace App\Domain\Contracts;

interface SupportContactContract
{
    public const TABLE = 'support_contacts';

    public const EMAIL  = 'email';
    public const PHONE  = 'phone';
    public const SECOND_PHONE = 'second_phone';
}
