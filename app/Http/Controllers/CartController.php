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

    public function accept(AcceptCartRequest $request): JsonResponse
    {
        $request = $request->validated();
        $result  = $this->cartServices->accept($request);
        return $this->sendResponse($result);
    }
}
