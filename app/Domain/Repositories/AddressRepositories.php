<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\AddressContract;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseRepository;

class AddressRepositories extends BaseRepository
{
    public function model(): Address
    {
        return new Address();
    }

    public function getAddresses($id)
    {
        return Address::query()
            ->where('id', $id)
            ->first()
            ;
    }

    public function showUserAddresses()
    {
        return Address::query()
            ->where(AddressContract::USER_ID, Auth::id())
            ->get()
            ;
    }

    public function updateAddresses(int $id, array $data)
    {
        return Address::query()
                        ->find($id)
                        ->update($data);
    }

    public function deleteAddresses(int $id)
    {
        $result = Address::query()
                         ->find($id)
            ;
        if (!isset($result)) {
            return false;
        }
        return $result->delete();
    }
}
