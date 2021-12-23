<?php

namespace App\Domain\Repositories;

use App\Models\TimeOfDelivery;
use Japananimetime\Template\BaseRepository;

class TimeDeliveryRepositories extends BaseRepository
{
    public function model(): TimeOfDelivery
    {
        return new TimeOfDelivery();
    }

    public function getTimeDelivery()
    {
        return TimeOfDelivery::all();
    }
}
