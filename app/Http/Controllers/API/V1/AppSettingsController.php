<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Services\AppSettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppSettingsController extends BaseController
{
    public AppSettingsService $appSettingsService;

    public function __construct(AppSettingsService $appSettingsService)
    {
        $this->appSettingsService = $appSettingsService;
    }

    public function city(): JsonResponse
    {
        $result = $this->appSettingsService->city();
        return $this->sendResponse($result);
    }

    public function getDeliveryCharges(): JsonResponse
    {
        $result = $this->appSettingsService->getDeliveryCharges();
        return $this->sendResponse($result);
    }

    public function getTimeDelivery(): JsonResponse
    {
        $result = $this->appSettingsService->getTimeDelivery();
        return $this->sendResponse($result);
    }

    public function paymentMethods(): JsonResponse
    {
        $result = $this->appSettingsService->getPaymentMethods;
        return  $this->sendResponse($result);
    }
}
