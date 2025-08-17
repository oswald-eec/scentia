<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\ManualPaymentController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('',[HomeController::class, 'index'])->middleware('can:Ver dashboard')->name('home');

Route::resource('roles',RoleController::class)->names('roles');

Route::resource('users',UserController::class)->names('users');
Route::get('users/students', [UserController::class, 'indexStudents'])->name('users.students');


Route::resource('categories', CategoryController::class)->names('categories');
Route::resource('subcategories', SubcategoryController::class)->names('subcategories');

Route::resource('levels', LevelController::class)->names('levels');

Route::resource('promotions', PromotionController::class)->names('promotions');

Route::resource('prices', PriceController::class)->names('prices');

Route::get('courses',[CourseController::class,'index'])->name('courses.index');

Route::get('courses/{course}',[CourseController::class,'show'])->name('courses.show');

Route::post('courses/{course}/approved',[CourseController::class,'approved'])->name('courses.approved');

Route::get('/payouts', [PayoutController::class, 'index'])->name('payouts.index');
Route::post('/payouts/{payout}/paid', [PayoutController::class, 'markAsPaid'])->name('payouts.markAsPaid');

Route::get('/manual-payments', [ManualPaymentController::class, 'adminIndex'])->name('manual-payments.index');
Route::post('/manual-payments/{payment}/approve', [ManualPaymentController::class, 'approve'])->name('manual-payments.approve');
Route::post('/manual-payments/{payment}/reject', [ManualPaymentController::class, 'reject'])->name('manual-payments.reject');

Route::post('courses/{course}/addHotmartLink', [CourseController::class, 'addHotmartLink'])->name('courses.addHotmartLink');