<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\DeliveryContract;
use App\Models\Delivery;
use Japananimetime\Template\BaseRepository;

class DeliveryChargerRepositories extends BaseRepository
{
    public function model(): Delivery
    {
        return new Delivery();
    }

    public function getPrice($city)
    {
        return Delivery::query()
            ->where(DeliveryContract::CITY, $city)
            ->select(DeliveryContract::PRICE)
            ->get()
        ;
    }
}
