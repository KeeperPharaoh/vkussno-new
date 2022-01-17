<?php

namespace App\Services;

use App\Domain\Contracts\AddressContract;
use App\Domain\Repositories\AddressRepositories;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Japananimetime\Template\BaseService;

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
        return $this->addressRepositories->findWhere([
            AddressContract::USER_ID => Auth::id()
            ]);
    }

    /**
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function add(array $attributes)
    {
        DB::beginTransaction();
        $attributes['user_id'] = Auth::id();
        $this->addressRepositories->create($attributes);
        DB::commit();
    }

    public function updateAddresses(int $id, array $attributes): string
    {
        try {
            DB::beginTransaction();
            $this->addressRepositories->update($attributes,$id);
            DB::commit();

            return 'Операция прошла успешно';

        } catch (Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function deleteAddresses(int $id): int
    {
        return $this->addressRepositories->delete($id);
    }
}
