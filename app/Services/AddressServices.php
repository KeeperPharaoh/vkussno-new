<?php

namespace App\Services;

use App\Domain\Repositories\AddressRepositories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Japananimetime\Template\BaseService;
use Symfony\Component\HttpFoundation\Response;

class AddressServices extends BaseService
{
    private AddressRepositories $addressRepositories;

    public function __construct(AddressRepositories $addressRepositories)
    {
        parent::__construct();
        $this->addressRepositories = $addressRepositories;
    }

    public function showUserAddresses()
    {
        return $this->addressRepositories->showUserAddresses();

    }

    public function add($attributes)
    {
        DB::beginTransaction();
        $attributes['user_id'] = Auth::id();
        $this->addressRepositories->create($attributes);
        DB::commit();
    }

    public function updateAddresses($id, $attributes): string
    {
        try {
            DB::beginTransaction();
            $this->addressRepositories->updateAddresses($id,$attributes);
            DB::commit();

            return 'Операция прошла успешно';

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function deleteAddresses($id)
    {
        return $this->addressRepositories->deleteAddresses($id);
    }
}
