<?php

namespace Database\Factories;

use App\Models\BoardConf;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoardData>
 */
class BoardDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conf = BoardConf::select('id')->inRandomOrder()->first();
        
        return [
            'board_id' => $conf->id,
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(5),
            'writer' => fake()->name(),
        ];
    }
}
