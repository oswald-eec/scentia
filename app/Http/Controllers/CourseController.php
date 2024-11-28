<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(){
        return view('courses.index');
    }

    public function show( Course $course){

        $this->authorize('published', $course);
         // Obtén los cursos que pertenecen a la misma categoría, excluyendo el curso actual
         $similares = Course::where('category_id', $course->category_id) // Utilizamos category_id del curso actual
                            ->where('id', '!=', $course->id)          // Excluimos el curso actual
                            ->where('status', 3)                      // Solo seleccionamos cursos publicados (status 3)
                            ->latest('id')                            // Ordenamos por los más recientes
                            ->take(5)                                 // Limitar a los 5 más recientes
                            ->get();
        return view('courses.show', compact('course','similares'));
    }

    public function enrolled(Course $course){
        
        $course->students()->attach(auth()->user()->id);

        return redirect()->route('course.status',$course);
    }

    public function status(Course $course){
        return view('courses.status', compact('course'));
    }
}
