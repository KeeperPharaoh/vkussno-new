<?php

namespace App\Domain\Repositories;

use App\Models\TimeOfDelivery;
use Carbon\Carbon;
use Japananimetime\Template\BaseRepository;

class TimeDeliveryRepositories extends BaseRepository
{
    public function model(): TimeOfDelivery
    {
        return new TimeOfDelivery();
    }

    public function getTimeId($id)
    {
        return TimeOfDelivery::query()
                             ->where('id', $id)
                             ->first()
        ;
    }

    public function getCurrentTimeDelivery()
    {
        dd(Carbon::now());

        $cart = TimeOfDelivery::query()
                                ->where();
    }
}
