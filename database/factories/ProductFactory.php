<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Contracts\ProductContract;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition()
    {
        return [
            ProductContract::SUBCATEGORY_ID =>  \App\Models\Category::query()->where('')->inRandomOrder()->first() ? \App\Models\Category::inRandomOrder()->first()->id : null,
            ProductContract::TITLE =>  $this->faker->title(),
            ProductContract::IMAGE =>  $this->faker->imageUrl(640, 480),
            ProductContract::DESCRIPTION =>  $this->faker->text,
            ProductContract::PRICE =>  $this->faker->randomNumber(),
        ];
    }
}
