<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Contracts\UserContract;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return [
            UserContract::NAME =>  $this->faker->name(),
            UserContract::EMAIL =>  $this->faker->email(),
            UserContract::EMAIL_VERIFIED_AT =>  $this->faker->unixTime(),
            UserContract::PHONE =>  $this->faker->phoneNumber,
            UserContract::PASSWORD =>  \Illuminate\Support\Facades\Hash::make('123456'),
            UserContract::REMEMBER_TOKEN =>  null
        ];
    }
}
