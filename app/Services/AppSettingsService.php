<?php

namespace App\Services;

use App\Domain\Repositories\CityRepositories;
use App\Domain\Repositories\DeliveryChargerRepositories;
use App\Domain\Repositories\TimeDeliveryRepositories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseService;

class AppSettingsService extends BaseService
{
    private CityRepositories $cityRepositories;
    private DeliveryChargerRepositories $deliveryChargerRepositories;
    private TimeDeliveryRepositories    $timeDeliveryRepositories;

    public function __construct(
        CityRepositories $cityRepositories,
        DeliveryChargerRepositories $deliveryChargerRepositories,
        TimeDeliveryRepositories    $timeDeliveryRepositories
    )
    {
        parent::__construct();
        $this->deliveryChargerRepositories = $deliveryChargerRepositories;
        $this->timeDeliveryRepositories    = $timeDeliveryRepositories;
        $this->cityRepositories = $cityRepositories;
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

    public function getPaymentMethods()
    {
//        return $this->
    }
}
