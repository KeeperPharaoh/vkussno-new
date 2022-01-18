<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\UserContract;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements UserContract
{
    public function model(): string
    {
        return User::class;
    }
}
