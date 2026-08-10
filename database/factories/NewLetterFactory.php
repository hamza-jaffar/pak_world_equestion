<?php

namespace Database\Factories;

use App\Models\NewLetter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NewLetter>
 */
class NewLetterFactory extends Factory
{
    protected $model = NewLetter::class;

    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
