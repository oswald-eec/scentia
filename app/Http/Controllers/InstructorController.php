<?php

namespace App\Http\Controllers;

use App\Models\InstructorRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Muestra la página de solicitud de instructor.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('teach-class');
    }
    
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'course_description' => 'required|string',
            'curriculum' => 'required|mimes:pdf|max:2048',
        ]);

        // Guardar el archivo en storage/app/public/curriculums
        $curriculumPath = $request->file('curriculum')->store('curriculums', 'public');

        // Guardar en base de datos
        InstructorRequest::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'course_description' => $request->course_description,
            'curriculum' => $curriculumPath,
        ]);

        return redirect()->back()->with('success', 'Tu solicitud ha sido enviada con éxito.');
    }
}
