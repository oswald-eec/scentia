<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CoursesStudents extends Component
{
    use WithPagination, AuthorizesRequests, WithFileUploads;
    public $course, $search;
    public $selectedStudent;
    public $showNotesModal = false;
    public $showCertificateModal = false;
    public $certificateFile;

    public function mount(Course $course){
        $this->course = $course;
        $this->authorize('dicatated',$course);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    /** Mostrar notas en modal */
    public function showNotes(User $student){
        $this->selectedStudent = $student;
        $this->showNotesModal = true;
    }

    /** Mostrar modal de certificado */
    public function showCertificate(User $student){
        $this->selectedStudent = $student;
        $this->showCertificateModal = true;
    }

    /** Subir certificado */
    public function uploadCertificate(){
        $this->validate([
            'certificateFile' => 'required|mimes:pdf|max:2048'
        ]);

        $path = $this->certificateFile->store('certificates','public');

        Certificate::updateOrCreate(
            ['user_id' => $this->selectedStudent->id, 'course_id' => $this->course->id],
            ['file_path' => $path, 'issued_at' => now()]
        );

        $this->reset('certificateFile');
        $this->showCertificateModal = false;
        session()->flash('message','Certificado cargado correctamente.');
    }

    public function render()
    {
        $students = $this->course->students()
                        ->where('name', 'LIKE', '%'. $this->search . '%')
                        ->paginate(4);

        return view('livewire.instructor.courses-students', compact('students'))->layout('layouts.instructor',['course'=>$this->course]);
    }
}
