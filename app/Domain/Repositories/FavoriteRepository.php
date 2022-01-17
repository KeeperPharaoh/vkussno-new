<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\FavoriteContract;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class FavoriteRepository extends BaseRepository implements FavoriteContract
{
    public function model(): string
    {
        return Favorite::class;
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
