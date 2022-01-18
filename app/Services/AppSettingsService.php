<?php

namespace App\Services;

use App\Domain\Contracts\CityContract;
use App\Domain\Contracts\DeliveryContract;
use App\Domain\Repositories\CityRepositories;
use App\Domain\Repositories\PaymentTypeRepository;
use App\Domain\Repositories\TimeDeliveryRepositories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseService;

class AppSettingsService extends BaseService
{
    private CityRepositories $cityRepositories;
    private TimeDeliveryRepositories $timeDeliveryRepositories;
    private PaymentTypeRepository $paymentTypeRepository;

    public function __construct(
        CityRepositories            $cityRepositories,
        TimeDeliveryRepositories    $timeDeliveryRepositories,
        PaymentTypeRepository       $paymentTypeRepository
    ) {
        parent::__construct();
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
        $city = Auth::guard('sanctum')
                    ->check() ? Auth::guard('sanctum')
                                    ->user()->city : "Алматы";

        return $this->cityRepositories->findWhere([
                                                      CityContract::CITY => $city,
                                                  ]);
    }

    public function getTimeDelivery(): Collection
    {
        return $this->timeDeliveryRepositories->all();
    }

    /** @noinspection PhpVoidFunctionResultUsedInspection
     * @noinspection PhpInconsistentReturnPointsInspection
     */
    public function getCurrentTimeDelivery()
    {
        if (!empty($this->timeDeliveryRepositories)) {
            return $this->timeDeliveryRepositories->getCurrentTimeDelivery();
        }
    }

    public function paymentTypes(): Collection
    {
        $results = $this->paymentTypeRepository->all();
        foreach ($results as $result) {
            $image = $result->image;
            $image = json_decode($image);
            $image = $image[0]->download_link;
            $result->image =  $image;
        }
        return $this->paymentTypeRepository->all();
    }
}
