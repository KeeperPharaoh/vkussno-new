<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\DeliveryContract;
use App\Models\Delivery;
use Prettus\Repository\Eloquent\BaseRepository;

class DeliveryChargerRepositories extends BaseRepository
{
    public function model(): string
    {
        return Delivery::class;
    }
}
