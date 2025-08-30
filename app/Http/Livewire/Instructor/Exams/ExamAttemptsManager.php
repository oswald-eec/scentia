<?php

namespace App\Http\Livewire\Instructor\Exams;

use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamAttempt;
use Livewire\Component;

class ExamAttemptsManager extends Component
{
    public $course, $exam;
    public $students = [];

    public function mount(Course $course, Exam $exam)
    {
        $this->course = $course;
        $this->exam = $exam;

        $this->students = $course->students->map(function ($student) use ($exam) {
            $attempt = ExamAttempt::where('exam_id', $exam->id)
                                  ->where('user_id', $student->id)
                                  ->first();

            return [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'score' => $attempt?->score,
                'passed' => $attempt?->passed,
            ];
        })->toArray();
    }

    public function saveAttempt($studentId, $score)
    {
        $attempt = ExamAttempt::updateOrCreate(
            ['exam_id' => $this->exam->id, 'user_id' => $studentId],
            [
                'score' => $score,
                'passed' => $score >= $this->exam->passing_score,
                'taken_at' => now(),
            ]
        );

        session()->flash('message', 'Nota registrada correctamente.');
    }

    public function render()
    {
        return view('livewire.instructor.exams.exam-attempts-manager')
            ->layout('layouts.instructor', ['course' => $this->course]);
    }
}