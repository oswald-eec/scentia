<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApprovedCourse;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CourseController extends Controller
{
    public function index(){
        $courses  = Course::where('status',2)->paginate(8);
        return view('admin.courses.index',compact('courses'));
    }

    public function show(Course $course){
        $this->authorize('revision', $course);
        return view('admin.courses.show', compact('course'));
    }

    public function approved(Course $course)
    {
        $this->authorize('revision', $course);

        // Verificar que el curso tenga lecciones, metas, requisitos y una imagen
        if (!$course->lessons->count()) {
            return redirect()->back()->with('info', 'El curso debe tener al menos una lección.');
        }

        if (!$course->goals->count()) {
            return redirect()->back()->with('info', 'El curso debe tener al menos una meta.');
        }

        if (!$course->requirements->count()) {
            return redirect()->back()->with('info', 'El curso debe tener al menos un requisito.');
        }

        if (!$course->image) {
            return redirect()->back()->with('info', 'El curso debe tener una imagen.');
        }

        // Cambiar el estado del curso si todos los requisitos se cumplen
        $course->status = 3;
        $course->save();

        // $mail = new ApprovedCourse($course);
        // Mail::to($course->teacher->email)->send($mail);
        

        return redirect()->route('admin.courses.index')->with('info', 'El curso ha sido publicado exitosamente.');
    }

}
