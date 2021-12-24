<?php

namespace App\Domain\Repositories;

use App\Models\City;
use Japananimetime\Template\BaseRepository;

class CityRepositories extends BaseRepository
{
    public function model(): City
    {
       return new City();
    }
}
