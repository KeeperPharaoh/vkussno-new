<?php

namespace App\Domain\Repositories;

use App\Models\PaymentType;
use Japananimetime\Template\BaseRepository;

class PaymentTypeRepository extends BaseRepository
{
    public function model(): PaymentType
    {
        return new PaymentType();
    }

    public function getType($id)
    {
        return PaymentType::query()
                        ->where('id',$id)
                        ->select('type')
                        ->first()
            ;

    }
}
