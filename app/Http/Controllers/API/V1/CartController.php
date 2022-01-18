<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AcceptCartRequest;
use App\Services\CartServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        return $this->cartServices->accept($request);
    }

    public function history(): JsonResponse
    {
        $data = $this->cartServices->history();
        return $this->sendResponse($data);
    }
}
