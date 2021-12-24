<?php

namespace App\Services;

use App\Domain\Repositories\CityRepositories;
use App\Domain\Repositories\DeliveryChargerRepositories;
use App\Domain\Repositories\PaymentTypeRepository;
use App\Domain\Repositories\TimeDeliveryRepositories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseService;

class AppSettingsService extends BaseService
{
    private CityRepositories            $cityRepositories;
    private DeliveryChargerRepositories $deliveryChargerRepositories;
    private TimeDeliveryRepositories    $timeDeliveryRepositories;
    private PaymentTypeRepository       $paymentTypeRepository;
    public function __construct(
        CityRepositories            $cityRepositories,
        DeliveryChargerRepositories $deliveryChargerRepositories,
        TimeDeliveryRepositories    $timeDeliveryRepositories,
        PaymentTypeRepository       $paymentTypeRepository
    )
    {
        parent::__construct();
        $this->deliveryChargerRepositories = $deliveryChargerRepositories;
        $this->timeDeliveryRepositories    = $timeDeliveryRepositories;
        $this->cityRepositories            = $cityRepositories;
        $this->paymentTypeRepository       = $paymentTypeRepository;
    }

    public function city(): Collection
    {
        return $this->cityRepositories->all();
    }

    public function getDeliveryCharges(): Collection
    {
        if (Auth::guard('sanctum')->check()) {
            $city = Auth::guard('sanctum')->user()->city;
        }else {
            $city = "Алматы";
        }
        return $this->deliveryChargerRepositories->getPrice($city);
    }

    public function getTimeDelivery()
    {
        return $this->timeDeliveryRepositories->getTimeDelivery();
    }

    public function getPaymentMethods(): Collection
    {
        return $this->paymentTypeRepository->all();
    }
}
