<?php

namespace App\Domain\Repositories;

use App\Models\SpecialCategory;
use App\Models\SupportContact;
use Prettus\Repository\Eloquent\BaseRepository;

class SupportContactsRepositories extends BaseRepository
{
    public function model(): string
    {
        return SupportContact::class;
    }
}
