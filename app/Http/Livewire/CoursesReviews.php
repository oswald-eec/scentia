<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Livewire\Component;

class CoursesReviews extends Component
{
    public $course_id, $comment;

    public $rating = 5;

    public function mount(Course $course){
        $this->course_id = $course->id;
    }

    public function render()
    {
        $course = Course::find($this->course_id);
        return view('livewire.courses-reviews', compact('course'));
    }

    public function store(){
        $course = Course::find($this->course_id);

        $course->reviews()->create([
            'comment' => $this->comment,
            'rating' => $this->rating,
            'user_id' => auth()->user()->id
        ]);
    }
}
