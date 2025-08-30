<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Certificate;
use Livewire\WithFileUploads;
use App\Models\Course;
use App\Models\User;
use Livewire\Component;

class StudentCertificates extends Component
{
    use WithFileUploads;

    public $course, $student, $file;

    protected $rules = [
        'file' => 'required|mimes:pdf|max:5120'
    ];

    public function mount(Course $course, User $student)
    {
        $this->course = $course;
        $this->student = $student;
    }

    public function upload()
    {
        $this->validate();

        $path = $this->file->store("certificates/courses/{$this->course->id}", 'public');

        Certificate::create([
            'user_id' => $this->student->id,
            'certifiable_id' => $this->course->id,
            'certifiable_type' => Course::class,
            'file_path' => $path,
            'issued_at' => now(),
        ]);

        $this->reset('file');
        session()->flash('message', 'Certificado cargado exitosamente.');
    }

    public function render()
    {
        $certificates = $this->student->certificates()
            ->where('certifiable_id', $this->course->id)
            ->where('certifiable_type', Course::class)
            ->get();

        return view('livewire.instructor.student-certificates', compact('certificates'));
    }
}
