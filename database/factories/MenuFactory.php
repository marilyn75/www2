<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $typeOptions = ['S', 'M', 'W'];
        $randomType = $typeOptions[array_rand($typeOptions)];

        return [
            'title' => fake()->word,
            'code' => fake()->word,
            'type' => $randomType,
        ];
    }
}
