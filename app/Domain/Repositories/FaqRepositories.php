<?php

namespace App\Domain\Repositories;

use App\Models\Faq;
use Prettus\Repository\Eloquent\BaseRepository;

class FaqRepositories extends BaseRepository
{
    public function model(): string
    {
        return Faq::class;
    }
}
