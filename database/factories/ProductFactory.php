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
            'name'=>$this->faker->company,
            'quantity'=>$this->faker->randomNumber,
            'description'=>$this->faker->text(30),
            'price'=>$this->faker->numberBetween($min = 1, $max = 1000),
            'status'=>'In Stock',
            'img'=>$this->faker->imageUrl($width = 640, $height = 480),
            'supplier'=>$this->faker->firstNameMale,
            'tags'=>$this->faker->word,
        ];
    }
}
