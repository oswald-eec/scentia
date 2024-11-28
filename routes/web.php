<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\CourseStatus;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('cursos', [CourseController::class,'index'])->name('courses.index');

Route::get('cursos/{course}', [CourseController::class,'show'])->name('course.show');

Route::middleware(['auth'])->get('/contacto', function () {
    return "Puedes ver este mensaje porque estás autenticado.";
})->name('contact.index');


Route::middleware('auth')->group(function () {
    Route::post('courses/{course}/enrolled', [CourseController::class, 'enrolled'])->name('courses.enrolled');
    Route::get('course-status/{course}',CourseStatus::class)->name('course.status');
});

