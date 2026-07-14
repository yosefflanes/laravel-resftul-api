<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::get('/categories', [CourseCategoryController::class, 'index']);
Route::get('/categories/{id}', [CourseCategoryController::class, 'show']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);

    Route::post('/categories', [CourseCategoryController::class, 'store']);
    Route::put('/categories/{id}', [CourseCategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CourseCategoryController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
