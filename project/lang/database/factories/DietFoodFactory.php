<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DietFood>
 */
class DietFoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "food_id"       => $this->faker->randomNumber(2)
            ,"d_id"         => $this->faker->randomNumber(1) // 수정해야됨
            ,"df_name"      => $this->faker->realText(10)
            ,"df_kcal"      => $this->faker->randomNumber(3)
            ,"df_carbs"     => $this->faker->randomNumber(2)
            ,"df_protein"   => $this->faker->randomNumber(2)
            ,"df_fat"       => $this->faker->randomNumber(2)
            ,"df_sugar"     => $this->faker->randomNumber(1)
            ,"df_sodium"    => $this->faker->randomNumber(1)
            ,"df_intake"    => $this->faker->randomNumber(1)
            ,"created_at"   => $this->faker->dateTimeBetween("-1months")
        ];
    }
}
