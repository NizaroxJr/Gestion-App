<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

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
            'tel'=>$this->faker->phoneNumber,
            'email'=>$this->faker->email,
            'Adresse'=>$this->faker->address
        ];
    }
}
