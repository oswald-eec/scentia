<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\Facades\Image as ImageIntervention;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Generar un nombre de archivo único para la imagen
        $imageName = $this->faker->uuid . '.jpg';  
        $imagePath = storage_path('app/public/cursos/' . $imageName);

        // Crear un fondo con un color sólido vibrante
        $background = ImageIntervention::canvas(640, 480, '#3498db'); // Fondo azul

        // Añadir el título del curso en la imagen
        $courseTitle = $this->faker->words(3, true);  // Título aleatorio para el curso
        $background->text($courseTitle, 320, 200, function ($font) {
            $font->size(36);  // Tamaño grande para el título
            $font->color('#ffffff');  // Blanco para que resalte
            $font->align('center');
            $font->valign('middle');
            $font->angle(0);
        });

        // Guardar la imagen
        $background->save($imagePath);

        // Retorna la URL correcta que apuntará al archivo en 'public/storage/cursos'
        return [
            'url' => 'cursos/' . basename($imagePath),
            
        ];
    }
}
