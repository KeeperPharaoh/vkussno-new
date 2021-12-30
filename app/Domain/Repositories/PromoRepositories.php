<?php

namespace App\Domain\Repositories;

use App\Models\PromoCode;
use Japananimetime\Template\BaseRepository;

class PromoRepositories extends BaseRepository
{
    public function model(): PromoCode
    {
        return new PromoCode();
    }
}
