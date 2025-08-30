<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['course_id','title','description','max_score','passing_score'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'exam_user')
                    ->withPivot('score', 'passed', 'taken_at')
                    ->withTimestamps();
    }

    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }
}
