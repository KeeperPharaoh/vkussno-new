<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Services\AddressServices;
use Illuminate\Http\JsonResponse;

class AddressController extends BaseController
{
    public AddressServices $addressServices;

    public function __construct(AddressServices $addressServices)
    {
        $this->addressServices = $addressServices;
    }

    public function showUserAddresses(): JsonResponse
    {
        $result = $this->addressServices->showUserAddresses();
        return $this->sendResponse($result);
    }

    /**
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function add(AddressRequest $request): JsonResponse
    {
        $attributes = $request->validated();
        $this->addressServices->add($attributes);
        return $this->sendSuccessMessage();
    }

    public function update($id,UpdateAddressRequest $request): JsonResponse
    {
        $request = $request->validated();
        $result  = $this->addressServices->updateAddresses($id, $request);
        return $this->sendSuccessMessage($result);
    }

    public function delete($id): JsonResponse
    {
        $result = $this->addressServices->deleteAddresses($id);

        if (!$result) {
            return $this->sendError('Адресс уже удален');
        }

        return $this->sendSuccessMessage();
    }
}
