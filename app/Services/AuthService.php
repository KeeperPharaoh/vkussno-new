<?php /** @noinspection ALL */

namespace App\Services;

use App\Domain\Contracts\UserContract;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Japananimetime\Template\BaseService;

class AuthService extends BaseService
{
    /**
     * @var \App\Domain\Repositories\UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function register(array $attributes): array
    {
        $attributes['password'] = bcrypt($attributes['password']);

        DB::beginTransaction();
        $user             = $this->userRepository->create($attributes);
        $success['token'] = $user->createToken('vkussno')->plainTextToken;
        DB::commit();

        $success['user']  = [
            'name'   => $user->name,
            'phone'  => $user->phone
        ];

        return $success;
    }

    public function login(array $attributes): array
    {
        $phone    = $attributes['phone'];
        $password = $attributes['password'];

        if(Auth::attempt([UserContract::PHONE => $phone, UserContract::PASSWORD => $password])) {
            $user            = Auth::user();
            $success         = ['token' => $user->createToken('MyApp')->plainTextToken];

            $success['user'] = [
                'phone_number' => $user->phone_number,
                'name'         => $user->name
            ];
            return $success;
        }
        else{
            return [];
        }
    }

    public function logout()
    {
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });
    }
}
