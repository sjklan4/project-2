<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodInfo>
 */
class FoodInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // "user_id"       => $this->faker->numberBetween(0,2)
            // ,"food_name"    => $this->faker->word()
            // ,"kcal"         => $this->faker->numberBetween(1,1000)
            // ,"carbs"        => $this->faker->numberBetween(1,100)
            // ,"protein"      => $this->faker->numberBetween(1,100)
            // ,"fat"          => $this->faker->numberBetween(1,100)
            // ,"sugar"        => $this->faker->randomNumber(1)
            // ,"sodium"       => $this->faker->randomNumber(1)
            // ,"serving"      => $this->faker->randomNumber(1)
            // ,"created_at"   => $this->faker->dateTimeBetween('-3 months')
        ];
    }
}
