<?php

namespace App\Domain\Contracts;

interface UserContract
{

    public const TABLE   = 'users';

    public const ID                = 'id';
    public const ROLE_ID           = 'role_id';
    public const NAME              = 'name';
    public const EMAIL             = 'email';
    public const AVATAR            = 'avatar';
    public const EMAIL_VERIFIED_AT = 'email_verified_at';
    public const PHONE             = 'phone';
    public const PASSWORD          = 'password';
    public const REMEMBER_TOKEN    = 'remember_token';
    public const SETTINGS          = 'settings';
    public const SUBSCRIPTION      = 'subscription';
    public const CITY              = 'city';
    public const LANGUAGE          = 'language';
    public const BONUS             = 'bonus';
}
