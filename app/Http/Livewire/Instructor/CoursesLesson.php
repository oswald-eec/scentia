<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use App\Models\Platform;
use App\Models\Section;
use Livewire\Component;

class CoursesLesson extends Component
{
    public $section, $lesson, $platforms;
    public $name, $platform_id = 1, $url;

    protected $rules = [
        'lesson.name' => 'required|string|max:255',
        'lesson.platform_id' => 'required|integer',
        'lesson.url' => 'required|url'
    ];

    // Expresiones regulares mejoradas para URL de YouTube y Vimeo
    protected $youtubeRegex = '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/(watch\?v=|embed\/|v\/)?([a-zA-Z0-9_-]{11})$/';
    protected $vimeoRegex = '/^(https?:\/\/)?(www\.)?vimeo\.com\/(\d+)(\/)?$/';

    public function mount(Section $section)
    {
        $this->section = $section;
        $this->platforms = Platform::all();
        $this->lesson = new Lesson();
    }

    public function render()
    {
        return view('livewire.instructor.courses-lesson');
    }

    public function store()
    {
        // Validar datos básicos
        $this->validate([
            'name' => 'required|string|max:255',
            'platform_id' => 'required|integer',
            'url' => 'required|url'
        ]);

        // Validar la URL según la plataforma seleccionada
        $this->validateUrl($this->url, $this->platform_id);

        Lesson::create([
            'name' => $this->name,
            'platform_id' => $this->platform_id,
            'url' => $this->url,
            'section_id' => $this->section->id
        ]);

        $this->reset(['name', 'platform_id', 'url']);
        $this->section = Section::find($this->section->id);
    }

    public function edit(Lesson $lesson)
    {
        $this->resetValidation();
        $this->lesson = $lesson;
    }

    public function update()
    {
        // Validar datos básicos
        $this->validate();

        // Validar la URL según la plataforma seleccionada
        $this->validateUrl($this->lesson->url, $this->lesson->platform_id);

        $this->lesson->save();
        $this->section = Section::find($this->section->id);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        $this->section = Section::find($this->section->id);
    }

    public function cancel()
    {
        $this->lesson = new Lesson();
    }

    private function validateUrl($url, $platform_id)
    {
        $regex = $platform_id == 1 ? $this->youtubeRegex : $this->vimeoRegex;

        if (!preg_match($regex, $url)) {
            $platformName = $platform_id == 1 ? 'YouTube' : 'Vimeo';
            $this->addError('lesson.url', "La URL no es válida para $platformName.");
        }
    }
}