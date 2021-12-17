<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Services\AddressServices;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

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

    public function add(AddressRequest $request): JsonResponse
    {
        $request = $request->validated();
        $this->addressServices->add($request);
        return $this->sendSuccessMessage();
    }

    public function update($id,UpdateAddressRequest $request): JsonResponse
    {
        $request = $request->validated();
        $result  = $this->addressServices->updateAddresses($id, $request);
        return $this->sendSuccessMessage($result);
    }

    public function delete(Request $request): JsonResponse
    {
        $id = $request->id;
        $result = $this->addressServices->deleteAddresses($id);

        if (!$result) {
            return $this->sendError('Адресс уже удален');
        }

        return $this->sendSuccessMessage();
    }
}
