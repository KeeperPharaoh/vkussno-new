<?php

namespace App\Domain\Repositories;

use App\Models\Benefits;
use Japananimetime\Template\BaseRepository;

class BenefitsRepositories extends BaseRepository
{
    public function model(): Benefits
    {
        return new Benefits();
    }
}
