<?php

namespace App\Http\Livewire\Instructor\Certificates;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CertificateManager extends Component
{
    use WithFileUploads;

    public $course, $student;
    public $certificateFile;

    public function mount(Course $course, User $student)
    {
        $this->course = $course;
        $this->student = $student;
    }

    public function uploadCertificate()
    {
        $this->validate([
            'certificateFile' => 'required|mimes:pdf|max:2048',
        ]);

        $path = $this->certificateFile->store('certificates', 'public');

        Certificate::updateOrCreate(
            ['user_id' => $this->student->id, 'course_id' => $this->course->id],
            ['file_path' => $path, 'issued_at' => now()]
        );

        session()->flash('message', 'Certificado subido correctamente.');
    }

    public function render()
    {
        $certificate = Certificate::where('user_id',$this->student->id)
                                  ->where('course_id',$this->course->id)
                                  ->first();

        return view('livewire.instructor.certificates.certificate-manager', compact('certificate'))
            ->layout('layouts.instructor', ['course' => $this->course]);
    }
}
