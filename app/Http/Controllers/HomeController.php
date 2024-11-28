<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

        return view('welcome', compact('popularCourses', 'mostPurchasedCourses', 'courses'));
    }
}
