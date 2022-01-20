<?php

namespace App\Domain\Repositories;

use App\Models\OrderStatus;
use Prettus\Repository\Eloquent\BaseRepository;

class OrderStatusRepositories extends BaseRepository
{
    public function model(): string
    {
        return OrderStatus::class;
    }
}
