<?php

namespace App\Domain\Repositories;

use App\Models\Bonus;
use Japananimetime\Template\BaseRepository;

class BonusRepositories extends BaseRepository
{
    public function model(): Bonus
    {
        return new Bonus();
    }

    public function getPercent()
    {
        return Bonus::query()->first();
    }
}
