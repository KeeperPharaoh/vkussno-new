<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\AddressContract;
use App\Models\Address;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class AddressRepositories extends BaseRepository implements AddressContract
{
    public function model(): string
    {
        return Address::class;
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
