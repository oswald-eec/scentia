<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Cursos más populares
        $popularCourses = Course::popular()->take(8)->get();

        // Cursos más comprados
        $mostPurchasedCourses = Course::mostPurchased()->take(8)->get();

        // Últimos cursos agregados
        $courses = Course::latestAdded()->take(8)->get();

        // Obtener los últimos 10 comentarios con datos de usuario y curso
        $reviews = Review::with(['user', 'course'])
        ->latest() // Orden por los comentarios más recientes
        ->take(10) // Limitar a 10 resultados
        ->get();

        return view('welcome', compact('popularCourses', 'mostPurchasedCourses', 'courses', 'reviews'));
    }
}
