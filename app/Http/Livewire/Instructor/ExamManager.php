<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Exam;
use Livewire\Component;

class ExamManager extends Component
{
    public $course;
    public $title, $description, $max_score = 100, $passing_score = 70;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'max_score' => 'required|integer|min:1',
            'passing_score' => 'required|integer|min:1|max:100',
        ]);

        Exam::create([
            'course_id' => $this->course->id,
            'title' => $this->title,
            'description' => $this->description,
            'max_score' => $this->max_score,
            'passing_score' => $this->passing_score,
        ]);

        $this->reset(['title','description','max_score','passing_score']);
        session()->flash('message', 'Examen creado correctamente.');
    }

    public function render()
    {
        $exams = $this->course->exams()->latest()->get();

        return view('livewire.instructor.exam-manager', compact('exams'))
            ->layout('layouts.instructor', ['course' => $this->course]);
    }
}
