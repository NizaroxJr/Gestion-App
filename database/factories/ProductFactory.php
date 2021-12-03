<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->unique()->randomDigit,
            'name'=>$this->faker->firstNameMale,
            'quantity'=>$this->faker->randomDigit,
            'description'=>$this->faker->text(30),
            'price'=>$this->faker->randomDigit,
            'status'=>$this->faker->text(30),
            'img'=>$this->faker->imageUrl($width = 640, $height = 480),
            'supplier'=>$this->faker->firstNameMale,
            'tags'=>$this->faker->text(10)
        ];
    }
}
