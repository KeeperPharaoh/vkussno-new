<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\AboutContract;
use App\Models\AboutCompany;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class AboutCompanyRepositories extends BaseRepository implements AboutContract
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return AboutCompany::class;
    }


    /**
     * Boot up the repository, pushing criteria
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
