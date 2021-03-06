<?php

namespace App\Services;

use App\Domain\Contracts\UserContract;
use App\Domain\Repositories\CityRepositories;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\Response;
use Japananimetime\Template\BaseService;
use Illuminate\Contracts\Auth\Authenticatable;
class UserService extends BaseService
{
    /**
     * @var \App\Domain\Repositories\UserRepository
     */
    private UserRepository   $userRepository;
    private CityRepositories $cityRepositories;
    /**
    * UserService constructor.
    */
    public function __construct(
        UserRepository    $userRepository,
        CityRepositories  $cityRepositories
    ) {
        parent::__construct();
        $this->userRepository   = $userRepository;
        $this->cityRepositories = $cityRepositories;
    }

    public function getProfile(): Authenticatable
    {
        return Auth::user();
    }

    public function updateProfile(array $attributes): string
    {
        try {

            if (isset($attributes['password'])) {
                $attributes['password'] = Hash::make($attributes['password']);
            }
            DB::beginTransaction();
            $this->userRepository->update($attributes,Auth::id());
            DB::commit();
            return 'Операция прошла успешно';

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    public function changeCity(int $id)
    {
        $city = $this->cityRepositories->find($id);
        DB::beginTransaction();
        try {
            $this->userRepository->update([
                                              UserContract::CITY => $city->city,
                                          ],Auth::id());
        } catch (ValidatorException $exception) {
            return false;
        }
        DB::commit();
        return true;
    }

    public function changeLanguage(int $id): bool
    {
       if ($id == 1) {
           $language = "ru";
       } else {
           $language = "kz";
       }
        try {
           DB::beginTransaction();
               $this->userRepository->update([
                   UserContract::LANGUAGE => $language
                                             ], Auth::id());
           DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
           return false;
        }
       return true;
    }
}
