<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Lesson;
use App\Support\VideoUrl;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class CourseStatus extends Component
{
    use AuthorizesRequests;

    public $course, $current;

    public $showGradesModal = false;

    public function mount(Course $course)
    {
        $this->authorize('enrolled', $course);

        $this->course = $course->load([
            'lessons.users',
            'exams.students',       // notas de exámenes
            'certificates'       // certificados
        ]);

        // Buscar la primera lección incompleta o la primera disponible
        $this->current = $this->course->lessons->firstWhere('complete', false) ?? $this->course->lessons->first();
    }

    public function render()
    {
        $embedUrl = null;

        if ($this->current && $this->current->platform_id && $this->current->video_id) {
            $embedUrl = VideoUrl::embedUrl(
                (string) $this->current->platform_id,
                (string) $this->current->video_id
            );
        }

        return view('livewire.course-status', [
            'embedUrl' => $embedUrl
        ]);
    }

    // Cambiar lección actual
    public function changeLesson($lessonId)
    {
        $this->current = Lesson::findOrFail($lessonId);
    }

    // Marcar lección completada / incompleta
    public function completed()
    {
        $userId = auth()->id();

        if ($this->current->complete) {
            $this->current->users()->detach($userId);
            $this->current->complete = false;
        } else {
            $this->current->users()->syncWithoutDetaching([$userId]);
            $this->current->complete = true;
        }

        // Refrescar datos
        $this->current->refresh();
        $this->course->refresh();
    }

    // Propiedades dinámicas
    public function getIndexProperty()
    {
        return $this->course->lessons->pluck('id')->search($this->current->id);
    }

    public function getPreviousProperty()
    {
        return $this->index > 0 ? $this->course->lessons[$this->index - 1] : null;
    }

    public function getNextProperty()
    {
        return $this->index < $this->course->lessons->count() - 1 ? $this->course->lessons[$this->index + 1] : null;
    }

    public function getAdvanceProperty()
    {
        $total = $this->course->lessons->count();
        $completed = $this->course->lessons->where('complete', true)->count();

        return $total > 0 ? round(($completed / $total) * 100, 2) : 0;
    }

    // Descarga de recurso
    public function download()
    {
        if ($this->current->resource && Storage::disk('public')->exists($this->current->resource->url)) {
            return Storage::disk('public')->download($this->current->resource->url);
        }

        session()->flash('error', 'El recurso no está disponible.');
        return null;
    }

    // Notas del estudiante autenticado
    public function getMyExamsProperty()
    {
        $studentId = auth()->id();

        return $this->course->exams->map(function ($exam) use ($studentId) {
            $record = $exam->students()->where('user_id', $studentId)->first();
            return [
                'title' => $exam->title,
                'score' => $record->pivot->score ?? null,
                'passed' => $record->pivot->passed ?? null,
            ];
        });
    }

    // Promedio del estudiante
    public function getMyAverageProperty()
    {
        $scores = collect($this->myExams)->pluck('score')->filter();
        return $scores->count() ? round($scores->avg(), 2) : null;
    }

    // Certificado del estudiante
    public function getMyCertificateProperty()
    {
        return $this->course->certificates()
            ->where('user_id', auth()->id())
            ->first();
    }

}



// {
//     use AuthorizesRequests;
//     public $course, $current;
    
//     public function mount(Course $course){
//         // $this->course = $course;

//         // Cargar la relación de lecciones con usuarios para optimizar consultas
//         $this->course = $course->load('lessons.users');

//         // Asignamos la primera lección incompleta o la primera lección si todas están completadas
//         $this->current = $course->lessons->firstWhere('complete', false) ?? $course->lessons->first();

//         $this->authorize('enrolled', $course);
//     }

//     public function render()
//     {
//         return view('livewire.course-status');
//     }

//     //Metodos

//     public function changeLesson(Lesson $lesson){
//         $this->current = $lesson;
//     }

//     public function completed(){
//         $userId = auth()->id();

//         if ($this->current->complete) {
//             // Si ya está completada, elimina el registro y cambia a gris
//             $this->current->users()->detach($userId);
//             $this->current->complete = false;
//         } else {
//             // Si no está completada, agrega el registro y cambia a azul
//             $this->current->users()->attach($userId);
//             $this->current->complete = true;
//         }

//         // Actualiza el estado del curso
//         // $this->current = $this->current->fresh();
//         // $this->course = $this->course->refresh();
//         $this->current = Lesson::find($this->current->id);
//         $this->course = Course::find($this->course->id);
//     }

//     //Propiedades

//     public function getIndexProperty()
//     {
//         return $this->course->lessons->pluck('id')->search($this->current->id);
//     }

//     public function getPreviousProperty()
//     {
//         return $this->index > 0 ? $this->course->lessons[$this->index - 1] : null;
//     }

//     public function getNextProperty()
//     {
//         return $this->index < $this->course->lessons->count() - 1 ? $this->course->lessons[$this->index + 1] : null;
//     }

//     public function getAdvanceProperty()
//     {
//         // Contamos las lecciones y aquellas que están completadas
//         $totalLessons = $this->course->lessons->count();
//         $completedLessons = $this->course->lessons->where('complete', true)->count();
        
//         $advance = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;
        
//         return round($advance, 2);
//     }

//     public function download(){
//         return response()->download(storage_path('app/public/' . $this->current->resource->url));
//     }
// }
