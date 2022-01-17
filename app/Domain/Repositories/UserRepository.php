<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\UserContract;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository implements UserContract
{
    public function model(): string
    {
        return User::class;
    }
}
