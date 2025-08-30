<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use App\Models\Platform;
use App\Models\Section;
use App\Support\VideoUrl;
use Livewire\Component;

class CoursesLesson extends Component
{
    public $section, $lesson, $platforms;
    public $name, $platform_id = null, $url, $duration;
    public $previewEmbedUrl = null;

    protected $rules = [
        'lesson.name' => 'required|string|max:255',
        'lesson.platform_id' => 'nullable|exists:platforms,id',
        'lesson.url' => 'required|url',
        'lesson.duration' => 'required|string|regex:/^\d{2}:\d{2}:\d{2}$/', // Validación para formato HH:MM:SS
    ];

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

    public function updatedUrl($value)
    {
        $parsed = VideoUrl::parse($value);
        $this->previewEmbedUrl = $parsed ? VideoUrl::embedUrl($parsed['platform_id'], $parsed['video_id']) : null;
        // Opcional: autoseleccionar plataforma visualmente
        $this->platform_id = $parsed['platform_id'] ?? null;
    }

    public function store()
    {
        $this->validate([
            'name'        => 'required|string|max:255',
            'url'         => 'required|url',
            'duration'    => 'required|string|regex:/^\d{2}:\d{2}:\d{2}$/',
            'platform_id' => 'nullable|exists:platforms,id',
        ]);

        $parsed = VideoUrl::parse($this->url);
        if (!$parsed) {
            $this->addError('url', 'La URL no corresponde a un video válido de YouTube/Vimeo.');
            return;
        }

        Lesson::create([
            'name'        => $this->name,
            'platform_id' => $parsed['platform_id'],
            'url'         => $this->url,
            'video_id'    => $parsed['video_id'],
            'duration'    => $this->duration, // por compat; Observer rellena duration_seconds
            'section_id'  => $this->section->id,
        ]);

        $this->reset(['name', 'platform_id', 'url', 'duration', 'previewEmbedUrl']);
        $this->section->refresh();
    }

    

    public function edit(Lesson $lesson)
    {
        $this->resetValidation();
        $this->lesson = $lesson;
    }

    public function update()
    {
        $this->validate();

        $parsed = VideoUrl::parse($this->lesson->url);
        if (!$parsed) {
            $this->addError('lesson.url', 'La URL no corresponde a un video válido de YouTube/Vimeo.');
            return;
        }

        $this->lesson->platform_id = $parsed['platform_id'];
        $this->lesson->video_id    = $parsed['video_id'];
        $this->lesson->save();

        $this->section->refresh();
    }


    public function destroy(Lesson $lesson)
    {
        // Eliminar la lección
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