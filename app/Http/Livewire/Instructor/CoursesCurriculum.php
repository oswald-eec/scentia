<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class CoursesCurriculum extends Component
{
    use AuthorizesRequests;
    public $course, $section, $name;

    protected $rules = [
        'section.name' => 'required',
    ];

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->section = new Section();

        $this->authorize('dicatated',$course);
    }

    public function render()
    {
        return view('livewire.instructor.courses-curriculum')->layout('layouts.instructor',['course'=>$this->course]);
    }

    public function store()
    {
        $this->validate(['name' => 'required']);

        $this->course->sections()->create(['name' => $this->name]);

        $this->reset('name');
        $this->refreshCourse();
    }

    public function edit(Section $section)
    {
        $this->section = $section;
    }

    public function update()
    {
        $this->validate();
        $this->section->save();

        $this->section = new Section();
        $this->refreshCourse();
    }

    public function destroy(Section $section)
    {
        $section->delete();
        $this->refreshCourse();
    }

    private function refreshCourse()
    {
        $this->course->load('sections');
    }
}
