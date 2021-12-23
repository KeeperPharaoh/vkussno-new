<?php

namespace App\Domain\Contracts;

interface SpecialCategoryContract
{
    public const TABLE = "special_categories";

    public const PROMOTIONAL = 'promotional_image';
    public const NEW         = 'new_image';
}
