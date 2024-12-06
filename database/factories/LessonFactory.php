<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'url' => 'https://youtu.be/v3Z9PFvrIts?si=Rz2aMDxsn6EUKJKn',
            'duration' => $this->generateDuration(), // Duración aleatoria
            'platform_id' => 1
        ];
    }

    /**
     * Genera una duración aleatoria en formato HH:MM:SS
     *
     * @return string
     */
    private function generateDuration()
    {
        $hours = str_pad(mt_rand(0, 2), 2, '0', STR_PAD_LEFT); // Máximo 2 horas
        $minutes = str_pad(mt_rand(0, 59), 2, '0', STR_PAD_LEFT);
        $seconds = str_pad(mt_rand(0, 59), 2, '0', STR_PAD_LEFT);

        return "$hours:$minutes:$seconds";
    }
}
