<?php

namespace App\Domain\Repositories;

use App\Models\City;
use Prettus\Repository\Eloquent\BaseRepository;

class CityRepositories extends BaseRepository
{
    public function model(): string
    {
        return City::class;
    }
}
