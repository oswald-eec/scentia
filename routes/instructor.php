<?php

use App\Http\Controllers\Instructor\CourseController;
use App\Http\Livewire\Instructor\CoursesCurriculum;
use App\Http\Livewire\Instructor\CoursesStudents;
use App\Http\Livewire\InstructorCourses;
use Illuminate\Support\Facades\Route;

Route::redirect('', 'instructor/courses');

Route::resource('courses', CourseController::class)->names('courses');

Route::get('courses/get-subcategories/{category}', [CourseController::class, 'getSubcategories']);

Route::get('courses/{course}/curriculum', CoursesCurriculum::class)->middleware('can:Editar cursos')->name('courses.curriculum');

Route::get('courses/{course}/goals', [CourseController::class,'goals'])->name('courses.goals');

Route::get('courses/{course}/students', CoursesStudents::class)->middleware('can:Editar cursos')->name('courses.students');

Route::post('courses/{course}/status', [CourseController::class,'status'])->name('courses.status');