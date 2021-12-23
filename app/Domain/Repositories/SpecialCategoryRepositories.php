<?php

namespace App\Domain\Repositories;

use App\Models\SpecialCategory;
use Japananimetime\Template\BaseRepository;

class SpecialCategoryRepositories extends BaseRepository
{
    public function model(): SpecialCategory
    {
        return new SpecialCategory();
    }

    public function first()
    {
        return SpecialCategory::query()->first();
    }
}
