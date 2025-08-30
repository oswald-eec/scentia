<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Exam;
use App\Models\User;
use Livewire\Component;

class StudentExams extends Component
{
    public $course, $student, $score, $title;

    protected $rules = [
        'title' => 'required|string|max:255',
        'score' => 'required|numeric|min:0|max:100',
    ];

    public function mount(Course $course, User $student)
    {
        $this->course = $course;
        $this->student = $student;
    }

    public function save()
    {
        $this->validate();

        Exam::create([
            'user_id' => $this->student->id,
            'course_id' => $this->course->id,
            'title' => $this->title,
            'score' => $this->score,
        ]);

        $this->reset(['title', 'score']);
        session()->flash('message', 'Evaluación registrada exitosamente.');
    }

    public function render()
    {
        $exams = Exam::where('user_id', $this->student->id)
                     ->where('course_id', $this->course->id)
                     ->get();

        return view('livewire.instructor.student-exams', compact('exams'));
    }
}
