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
        
        // Obtener el usuario administrador creado en UserSeeder
        $admin = User::where('email', 'oss.dev@test.com')->first();

        // $courses = Course::factory(100)->create();

        // foreach ($courses as $course) {

        //     Review::factory(5)->create([
        //         'course_id' => $course->id
        //     ]);

        //     Image::factory(1)->create([
        //         'imageable_id' => $course->id,
        //         'imageable_type' => Course::class
        //     ]);

        //     Requirement::factory(4)->create([
        //         'course_id' => $course->id
        //     ]);

        //     Goal::factory(4)->create([
        //         'course_id' => $course->id
        //     ]);

        //     Audience::factory(4)->create([
        //         'course_id' => $course->id
        //     ]);

        //     $sections = Section::factory(4)->create([
        //         'course_id' => $course->id
        //     ]);

        //     foreach($sections as $section){
        //         $lessons = Lesson::factory(4)->create(['section_id' => $section->id]);

        //         foreach($lessons as $lesson){
        //             Description::factory(1)->create(['lesson_id' => $lesson->id]);
        //         }
        //     }
        // }

        $courses = Course::factory(100)->create();

        foreach ($courses as $course) {
            // Generar reviews con evaluaciones realistas para popularidad
            $reviews = Review::factory(rand(5, 15))->create([
                'course_id' => $course->id
            ]);

            // Calcular la calificación promedio del curso
            $averageRating = $reviews->avg('rating');
            $course->update(['average_rating' => $averageRating]);

            // Asociar una imagen al curso
            Image::factory(1)->create([
                'imageable_id' => $course->id,
                'imageable_type' => Course::class
            ]);

            // Crear requisitos, objetivos y audiencia
            Requirement::factory(4)->create(['course_id' => $course->id]);
            Goal::factory(4)->create(['course_id' => $course->id]);
            Audience::factory(4)->create(['course_id' => $course->id]);

            // Crear secciones, lecciones y descripciones
            $sections = Section::factory(4)->create(['course_id' => $course->id]);
            foreach ($sections as $section) {
                $lessons = Lesson::factory(4)->create(['section_id' => $section->id]);
                foreach ($lessons as $lesson) {
                    Description::factory(1)->create(['lesson_id' => $lesson->id]);
                }
            }

            // Simular estudiantes inscritos para cálculo de cursos más comprados
            $students = User::inRandomOrder()->limit(rand(10, 100))->pluck('id');
            $course->students()->sync($students);
        }
    }
}
