<?php

namespace App\Domain\Repositories;

use App\Models\PaymentType;
use Prettus\Repository\Eloquent\BaseRepository;

class PaymentTypeRepository extends BaseRepository
{
    public function model(): string
    {
        return PaymentType::class;
    }

}
