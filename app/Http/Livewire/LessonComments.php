<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Lesson;
use Livewire\Component;

class LessonComments extends Component
{
    public $lesson;          // La lección a la que pertenecen los comentarios
    public $course;
    public $commentText = ''; // Texto del nuevo comentario
    public $replyText = '';   // Texto de respuesta
    public $replyTo = null;   // ID del comentario al que se está respondiendo

    protected $rules = [
        'commentText' => 'required|string|min:3|max:1000',
        'replyText'   => 'nullable|string|min:1|max:1000',
    ];

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->course = $lesson->section->course;
    }

    public function render()
    {
        return view('livewire.lesson-comments', [
            'comments' => $this->lesson->comments()
                ->whereNull('parent_id') // Solo comentarios raíz
                ->with(['user', 'replies.user']) // Optimiza carga de relaciones
                ->latest()
                ->get(),
        ]);
    }

    /**
     * Guardar un nuevo comentario raíz
     */
    public function store()
    {
        $this->validateOnly('commentText');

        Comment::create([
            'name'              => $this->commentText,
            'user_id'           => auth()->id(),
            'commentable_id'    => $this->lesson->id,
            'commentable_type'  => Lesson::class,
            'parent_id'         => null,
        ]);

        $this->reset('commentText');
    }

    /**
     * Guardar respuesta a un comentario
     */
    public function reply($commentId)
    {
        $this->validateOnly('replyText');

        Comment::create([
            'name'              => $this->replyText,
            'user_id'           => auth()->id(),
            'commentable_id'    => $this->lesson->id,
            'commentable_type'  => Lesson::class,
            'parent_id'         => $commentId,
        ]);

        $this->reset(['replyText', 'replyTo']);
    }

    /**
     * Cancelar respuesta
     */
    public function cancelReply()
    {
        $this->reset(['replyText', 'replyTo']);
    }
}
