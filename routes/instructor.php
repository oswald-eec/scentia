<?php

use App\Http\Controllers\Instructor\CourseController;
use App\Http\Livewire\Instructor\Certificates\CertificateManager;
use App\Http\Livewire\Instructor\CoursesCurriculum;
use App\Http\Livewire\Instructor\CoursesStudents;
use App\Http\Livewire\Instructor\ExamManager;
use App\Http\Livewire\Instructor\Exams\ExamAttemptsManager;
use App\Http\Livewire\Instructor\StudentCertificates;
use App\Http\Livewire\Instructor\StudentExams;
use App\Http\Livewire\InstructorCourses;
use Illuminate\Support\Facades\Route;

Route::redirect('', 'instructor/courses');

Route::resource('courses', CourseController::class)->names('courses');

Route::get('courses/subcategories/{category}', [CourseController::class, 'getSubcategories'])->name('courses.subcategories');

Route::get('courses/{course}/curriculum', CoursesCurriculum::class)->middleware('can:Editar cursos')->name('courses.curriculum');

Route::get('courses/{course}/goals', [CourseController::class,'goals'])->name('courses.goals');

Route::get('courses/{course}/students', CoursesStudents::class)->middleware('can:Editar cursos')->name('courses.students');

// Evaluaciones
Route::get('courses/{course}/exams', ExamManager::class)->name('courses.exams');
Route::get('courses/{course}/exams/{exam}/attempts', ExamAttemptsManager::class)->name('courses.exams.attempts');
Route::get('instructor/courses/{course}/students/{student}/exams', StudentExams::class)->name('students.exams');

// Certificados
Route::get('courses/{course}/students/{student}/certificate', CertificateManager::class)->name('courses.students.certificate');
Route::get('instructor/courses/{course}/students/{student}/certificates', StudentCertificates::class)
    ->name('students.certificates');

Route::post('courses/{course}/status', [CourseController::class,'status'])->name('courses.status');