<?php

namespace App\Domain\Repositories;

use App\Models\Faq;
use Japananimetime\Template\BaseRepository;

class FaqRepositories extends BaseRepository
{
    public function model(): Faq
    {
        return new Faq();
    }
}
