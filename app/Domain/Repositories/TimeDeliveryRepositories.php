<?php

namespace App\Domain\Repositories;

use App\Models\TimeOfDelivery;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;

class TimeDeliveryRepositories extends BaseRepository
{
    public function model(): string
    {
        return TimeOfDelivery::class;
    }

    public function getCurrentTimeDelivery()
    {
        dd(Carbon::now());

        $cart = TimeOfDelivery::query()
                                ->where();
    }
}
