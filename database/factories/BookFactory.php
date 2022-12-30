<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->userName(),
            'author' => 1,
            'publisher_id' => 1,
            'cathegory_id' => 1,
            'ageToRent' => rand(0,18)
        ];
    }
}
