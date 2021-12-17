<?php

namespace App\Services;

use App\Domain\Contracts\UserContract;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function updateProfile($attributes): string
    {
        try {
            DB::beginTransaction();
            $this->userRepository->updateProfile($attributes);
            DB::commit();

            return 'Операция прошла успешно';
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }
}
