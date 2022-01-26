<?php

namespace App\Services;

use App\Domain\Contracts\CityContract;
use App\Domain\Repositories\CityRepositories;
use App\Domain\Repositories\PaymentTypeRepository;
use App\Domain\Repositories\SupportContactsRepositories;
use App\Domain\Repositories\TimeDeliveryRepositories;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseService;

class AppSettingsService extends BaseService
{
    private CityRepositories $cityRepositories;
    private TimeDeliveryRepositories $timeDeliveryRepositories;
    private PaymentTypeRepository $paymentTypeRepository;
    private SupportContactsRepositories $supportContactsRepositories;

    public function __construct(
        CityRepositories            $cityRepositories,
        TimeDeliveryRepositories    $timeDeliveryRepositories,
        PaymentTypeRepository       $paymentTypeRepository,
        SupportContactsRepositories $supportContactsRepositories
    ) {
        parent::__construct();
        $this->timeDeliveryRepositories    = $timeDeliveryRepositories;
        $this->cityRepositories            = $cityRepositories;
        $this->paymentTypeRepository       = $paymentTypeRepository;
        $this->supportContactsRepositories = $supportContactsRepositories;
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

            $result->status = true;
        }
        return $results;
    }

    public function soonestDeliveryTime()
    {
        $times = $this->timeDeliveryRepositories->all();
        $currentTime = Carbon::now();
        $differences = [];

        foreach ($times as $time) {
            $beginTime = Carbon::parse($time->beginning_time);
            $endTime   = Carbon::parse($time->end_time);
            if ($currentTime > $beginTime && $currentTime < $endTime) {
                return $time;
            } else {
                $differences[] = [
                    'id'   => $time->id,
                    'diff' => $beginTime->diffInMinutes()
                ];
            }
        }
        $difference = array_column($differences, 'diff');
        $diff = min($difference);
        foreach ($differences as $difference) {
            if ($diff == $difference['diff']) {
                return $this->timeDeliveryRepositories->find($difference['id']);
            }
        }
        return false;
    }

    public function contacts()
    {
        return $this->supportContactsRepositories->first();
    }
}
