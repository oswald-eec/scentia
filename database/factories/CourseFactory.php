<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\Price;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        
        return [
            'title'=> $title,
            'subtitle' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement([Course::BORRADOR, Course::REVISION, Course::PUBLICADO]),
            'slug' => Str::slug($title),
            // 'user_id' => User::all()->random()->id,
            'user_id' => User::inRandomOrder()->first()->id, // Selección aleatoria de un usuario
            'level_id' => Level::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'price_id' => Price::inRandomOrder()->first()->id,
            'average_rating' => null, // Se calculará después
        ];
    }
}
