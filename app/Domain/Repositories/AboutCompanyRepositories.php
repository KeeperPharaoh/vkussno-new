<?php

namespace App\Domain\Repositories;

use App\Models\AboutCompany;
use Japananimetime\Template\BaseRepository;

class AboutCompanyRepositories extends BaseRepository
{
    public function model(): AboutCompany
    {
        return new AboutCompany();
    }
}
