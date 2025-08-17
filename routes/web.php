<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ManualPaymentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermsController;
use App\Http\Livewire\CourseStatus;
use App\Http\Livewire\Student\Courses;
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
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy');
Route::get('/terms', [TermsController::class, 'index'])->name('terms');
Route::get('/teach-class', [InstructorController::class, 'index'])->name('teach-class');
Route::post('/teach-class', [InstructorController::class, 'store'])->name('instructor.request');

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
    Route::get('/mis-cursos', Courses::class)->name('student.courses');
    
    Route::post('courses/{course}/enrolled', [CourseController::class, 'enrolled'])->name('courses.enrolled');
    Route::get('course-status/{course}',CourseStatus::class)->name('course.status');

    Route::get('/payment/manual/{course}', [ManualPaymentController::class, 'create'])->name('manual.payment.create');
    Route::post('/payment/manual/store', [ManualPaymentController::class, 'store'])->name('manual.payment.store');
});

