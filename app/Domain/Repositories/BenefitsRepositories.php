<?php

namespace App\Domain\Repositories;

use App\Models\Benefits;
use Prettus\Repository\Eloquent\BaseRepository;

class BenefitsRepositories extends BaseRepository
{
    public function model(): string
    {
        return Benefits::class;
    }
}
