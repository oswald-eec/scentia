<?php

namespace App\Http\Livewire\Student;

use App\Models\Payment;
use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Courses extends Component
{
    public $estadoFiltro = 'todos';
    public $courses = [];

    public function updatedEstadoFiltro()
    {
        $this->loadCourses();
    }

    public function mount()
    {
        $this->loadCourses();
    }

    private function loadCourses()
    {
        $user = Auth::user();

        // Cursos con pagos registrados por el usuario (aunque no esté inscrito todavía)
        $payments = Payment::where('user_id', $user->id)
            ->with('course.image', 'course.teacher')
            ->orderByDesc('created_at')
            ->get();

        // Usamos el último pago de cada curso
        $grouped = $payments->groupBy('course_id')->map(function ($payments) use ($user) {
            $latest = $payments->first(); // último intento de pago
            $course = $latest->course;
            $course->status = $this->getEnrollmentStatus($course, $user);
            return $course;
        });

        // Cursos oficialmente inscritos desde course_user (por si acaso algún curso no tiene payment registrado)
        $inscribedCourses = $user->courses_enrolled()->with('price', 'image', 'teacher')->get()->map(function ($course) use ($user) {
            $course->status = 'cursando';
            return $course;
        });

        // Mezclamos ambas colecciones y evitamos duplicados
        $this->courses = $inscribedCourses->merge($grouped)->unique('id')->values();

        if ($this->estadoFiltro !== 'todos') {
            $this->courses = $this->courses->where('status', $this->estadoFiltro)->values();
        }
    }



    private function getEnrollmentStatus($course, $user)
    {
        $payment = Payment::where('user_id', $user->id)
                        ->where('course_id', $course->id)
                        ->orderByDesc('created_at')
                        ->first();

        if (!$payment) {
            return 'no_pagado'; // no ha pagado aún
        }

        if ($payment->status === 'completed') {
            return 'cursando';
        }

        if ($payment->status === 'pending' && $payment->method === 'airtm') {
            return 'pendiente_aprobacion';
        }

        return 'no_pagado'; // fallido o pendiente con otro método
    }

    public function render()
    {
        return view('livewire.student.courses');
    }
}
