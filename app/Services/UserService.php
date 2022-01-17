<?php

namespace App\Services;

use App\Domain\Contracts\UserContract;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Japananimetime\Template\BaseService;
use Illuminate\Contracts\Auth\Authenticatable;
class UserService extends BaseService
{
    /**
     * @var \App\Domain\Repositories\UserRepository
     */
    private UserRepository $userRepository;

    /**
    * UserService constructor.
    */
    public function __construct(UserRepository $userRepository) {
        parent::__construct();
        $this->userRepository = $userRepository;
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
}
