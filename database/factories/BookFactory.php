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
            'author' => rand(1,3),
            'publisher_id' => rand(1,4),
            'cathegory_id' => rand(1,4),
            'ageToRent' => rand(0,18)
        ];
    }
}
