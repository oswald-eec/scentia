<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class CourseStatus extends Component
{
    use AuthorizesRequests;
    public $course, $current;
    
    public function mount(Course $course){
        // $this->course = $course;

        // Cargar la relación de lecciones con usuarios para optimizar consultas
        $this->course = $course->load('lessons.users');

        // Asignamos la primera lección incompleta o la primera lección si todas están completadas
        $this->current = $course->lessons->firstWhere('complete', false) ?? $course->lessons->first();

        $this->authorize('enrolled', $course);
    }

    public function render()
    {
        return view('livewire.course-status');
    }

    //Metodos

    public function changeLesson(Lesson $lesson){
        $this->current = $lesson;
    }

    public function completed(){
        $userId = auth()->id();

        if ($this->current->complete) {
            // Si ya está completada, elimina el registro y cambia a gris
            $this->current->users()->detach($userId);
            $this->current->complete = false;
        } else {
            // Si no está completada, agrega el registro y cambia a azul
            $this->current->users()->attach($userId);
            $this->current->complete = true;
        }

        // Actualiza el estado del curso
        // $this->current = $this->current->fresh();
        // $this->course = $this->course->refresh();
        $this->current = Lesson::find($this->current->id);
        $this->course = Course::find($this->course->id);
    }

    //Propiedades

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
        // Contamos las lecciones y aquellas que están completadas
        $totalLessons = $this->course->lessons->count();
        $completedLessons = $this->course->lessons->where('complete', true)->count();
        
        $advance = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;
        
        return round($advance, 2);
    }

    public function download(){
        return response()->download(storage_path('app/public/' . $this->current->resource->url));
    }
}
