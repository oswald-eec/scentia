<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Livewire\Component;

class CoursesReviews extends Component
{
    public $course_id, $comment, $rating = 5;
    public $averageRating, $totalReviews, $ratingPercentages;

    public function mount(Course $course)
    {
        $this->course_id = $course->id;
        $this->calculateStatistics();
    }

    public function render()
    {
        $course = Course::find($this->course_id);

        return view('livewire.courses-reviews', compact('course'));
    }

    public function store()
    {
        $course = Course::find($this->course_id);

        $course->reviews()->create([
            'comment' => $this->comment,
            'rating' => $this->rating,
            'user_id' => auth()->user()->id
        ]);

        $this->reset(['comment', 'rating']);
        $this->calculateStatistics(); // Recalcula las estadísticas después de guardar
    }

    private function calculateStatistics()
    {
        $course = Course::find($this->course_id);

        $this->totalReviews = $course->reviews()->count();

        if ($this->totalReviews > 0) {
            $this->averageRating = round($course->reviews()->avg('rating'), 1);

            // Calcular porcentajes para cada rango de estrellas
            $ratings = $course->reviews()
                ->selectRaw('rating, COUNT(*) as count')
                ->groupBy('rating')
                ->pluck('count', 'rating');

            $this->ratingPercentages = [];
            for ($i = 1; $i <= 5; $i++) {
                $this->ratingPercentages[$i] = isset($ratings[$i])
                    ? round(($ratings[$i] / $this->totalReviews) * 100)
                    : 0;
            }
        } else {
            $this->averageRating = 0;
            $this->ratingPercentages = array_fill(1, 5, 0);
        }
    }
}
