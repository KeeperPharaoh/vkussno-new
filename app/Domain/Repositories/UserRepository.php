<?php

namespace App\Domain\Repositories;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Japananimetime\Template\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{

    public function model(): User
    {
        return new User();
    }

    public function updateProfile($data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return User::query()
                      ->find(Auth::id())
                      ->update($data);
    }
}
