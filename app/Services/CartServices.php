<?php

namespace App\Services;

use App\Domain\Repositories\CartRepositories;
use App\Domain\Repositories\DeliveryChargerRepositories;
use App\Domain\Repositories\ProductRepository;
use App\Domain\Repositories\TimeDeliveryRepositories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseRepository;
use Japananimetime\Template\BaseService;

class CartServices extends BaseService
{
    private CartRepositories            $cartRepositories;
    private DeliveryChargerRepositories $deliveryChargerRepositories;
    private TimeDeliveryRepositories    $timeDeliveryRepositories;
    private ProductRepository           $productRepository;
    public function __construct(
        CartRepositories            $cartRepositories,
        DeliveryChargerRepositories $deliveryChargerRepositories,
        TimeDeliveryRepositories    $timeDeliveryRepositories,
        ProductRepository           $productRepository
    )
    {
        parent::__construct();

        $this->deliveryChargerRepositories = $deliveryChargerRepositories;
        $this->timeDeliveryRepositories    = $timeDeliveryRepositories;
        $this->productRepository           = $productRepository;
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

    public function accept($attributes)
    {

    }
}
