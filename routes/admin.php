<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('',[HomeController::class, 'index'])->middleware('can:Ver dashboard')->name('home');

Route::resource('roles',RoleController::class)->names('roles');

Route::resource('users',UserController::class)->names('users');

Route::resource('categories', CategoryController::class)->names('categories');

Route::resource('levels', LevelController::class)->names('levels');

Route::resource('prices', PriceController::class)->names('prices');

Route::get('courses',[CourseController::class,'index'])->name('courses.index');

Route::get('courses/{course}',[CourseController::class,'show'])->name('courses.show');

Route::post('courses/{course}/approved',[CourseController::class,'approved'])->name('courses.approved');

Route::post('courses/{course}/addHotmartLink', [CourseController::class, 'addHotmartLink'])->name('courses.addHotmartLink');