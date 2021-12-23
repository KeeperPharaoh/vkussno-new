<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptCartRequest;
use App\Services\CartServices;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartController extends BaseController
{
    public CartServices $cartServices;

    public function __construct(CartServices $cartServices)
    {
        $this->cartServices = $cartServices;
    }

    public function getDeliveryCharges(): JsonResponse
    {
        $result = $this->cartServices->getDeliveryCharges();
        return $this->sendResponse($result);
    }

    public function getTimeDelivery(): JsonResponse
    {
        $result = $this->cartServices->getTimeDelivery();
        return $this->sendResponse($result);
    }

    public function accept(AcceptCartRequest $request): JsonResponse
    {
        $request = $request->validated();
        $result  = $this->cartServices->accept($request);
        return $this->sendResponse($result);
    }
}
