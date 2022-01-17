<?php

namespace App\Domain\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface AboutContract extends RepositoryInterface
{
    public const TABLE = 'about_companies';

    public const TITLE        = 'title';
    public const DESCRIPTION  = 'description';
}
