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
            // 'iframe' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/v3Z9PFvrIts?si=Rz2aMDxsn6EUKJKn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
            'iframe' => 'https://www.youtube.com/embed/v3Z9PFvrIts?si=Rz2aMDxsn6EUKJKn',
            'platform_id' => 1
        ];
    }
}
