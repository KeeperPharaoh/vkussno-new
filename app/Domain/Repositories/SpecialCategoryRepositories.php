<?php

namespace App\Domain\Repositories;

use App\Models\SpecialCategory;
use Prettus\Repository\Eloquent\BaseRepository;

class SpecialCategoryRepositories extends BaseRepository
{
    public function model(): string
    {
        return SpecialCategory::class;
    }
}
