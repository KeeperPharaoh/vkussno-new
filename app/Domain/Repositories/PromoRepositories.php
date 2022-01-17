<?php

namespace App\Domain\Repositories;

use App\Models\PromoCode;
use Prettus\Repository\Eloquent\BaseRepository;

class PromoRepositories extends BaseRepository
{
    public function model(): string
    {
        return PromoCode::class;
    }
}
