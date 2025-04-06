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
        $courses  = Course::where('status',2)->latest('id')->paginate(8);
        return view('admin.courses.index',compact('courses'));
    }

    public function show(Course $course){
        $this->authorize('revision', $course);
        return view('admin.courses.show', compact('course'));
    }

    public function approved(Course $course, Request $request)
    {
        // Verificar que el usuario tenga permiso para aprobar el curso
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

        // Verificar si el campo hotmart_link está presente en la solicitud
        if ($request->has('hotmart_link') && !empty($request->hotmart_link)) {
            // Validar y guardar el enlace de afiliado de Hotmart
            $course->hotmart_link = $request->hotmart_link;
        }

        // Cambiar el estado del curso si todos los requisitos se cumplen
        $course->status = 3;
        $course->save();

        // Enviar un correo de aprobación (comentado por ahora)
        // $mail = new ApprovedCourse($course);
        // Mail::to($course->teacher->email)->send($mail);

        return redirect()->route('admin.courses.index')->with('info', 'El curso ha sido publicado exitosamente.');
    }

    public function addHotmartLink(Request $request, Course $course)
    {
        // Validación para el campo hotmart_link
        $validatedData = $request->validate([
            'hotmart_link' => 'required|url',  // El campo hotmart_link es obligatorio y debe ser una URL válida
        ]);

        // Actualizar el curso con el nuevo link de Hotmart
        $course->hotmart_link = $validatedData['hotmart_link'];  // Usamos los datos validados
        $course->save();

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->back()->with('success', 'El link de afiliado de Hotmart ha sido agregado exitosamente.');
    }

}
