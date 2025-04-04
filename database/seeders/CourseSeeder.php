<?php

namespace Database\Seeders;

use App\Models\Audience;
use App\Models\Course;
use App\Models\Description;
use App\Models\Goal;
use App\Models\Image;
use App\Models\Lesson;
use App\Models\Requirement;
use App\Models\Review;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Obtener el administrador e instructor
        $admin = User::where('email', 'oss.dev@test.com')->first();
        $instructor = User::where('email', 'estb.dev@test.com')->first();


        // Crear 100 cursos usando el factory
        $courses = Course::factory(100)->create();

        // Cargar previamente usuarios para evitar consultas repetitivas
        $users = User::pluck('id');

        foreach ($courses as $course) {
            // Generar reviews para cada curso
            $reviews = Review::factory(rand(5, 15))->create(['course_id' => $course->id]);

            // Calcular y actualizar la calificación promedio del curso
            $averageRating = $reviews->avg('rating');
            $course->update(['average_rating' => $averageRating]);

            // Asociar una imagen al curso
            Image::factory()->create([
                'imageable_id' => $course->id,
                'imageable_type' => Course::class,
            ]);

            // Crear requisitos, objetivos y audiencia del curso
            Requirement::factory(4)->create(['course_id' => $course->id]);
            Goal::factory(4)->create(['course_id' => $course->id]);
            Audience::factory(4)->create(['course_id' => $course->id]);

            // Crear secciones, lecciones y descripciones
            $sections = Section::factory(4)->create(['course_id' => $course->id]);
            foreach ($sections as $section) {
                $lessons = Lesson::factory(4)->create(['section_id' => $section->id]);
                foreach ($lessons as $lesson) {
                    Description::factory()->create(['lesson_id' => $lesson->id]);
                }
            }

            // Simular estudiantes inscritos para el curso
            $students = $users->random(rand(10, 100)); // Selección aleatoria de usuarios
            $course->students()->sync($students);

            $studentData = [];
            foreach ($students as $studentId) {
                $studentData[$studentId] = [
                    'purchased_at' => now()->subDays(rand(0, 365)), // Fecha aleatoria en el último año
                    'price_paid' => $course->price->value ?? 0,
                ];
            }

            // Sincronizar los estudiantes sin duplicar entradas existentes
            $course->students()->syncWithoutDetaching($studentData);
        }
    }
}
