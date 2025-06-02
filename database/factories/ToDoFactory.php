<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ToDo>
 */
class ToDoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->jobTitle(),
            'created_date' => fake()->dateTimeThisMonth(),
            'priority' => ''/*array_rand(["P0 (high)", "P1 (medium)", "P2 (low)"], 2)[0]*/ ,
            'status' => ''/*array_rand(["Completed", "In progress"], 2)[1]*/ ,
        ];
    }
}
