<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::middleware('auth:sanctum')->group(function (){
//     Route::resource('courses',\App\Http\Controllers\CourseController::class);
// });
Route::resource('courses',\App\Http\Controllers\CourseController::class);

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});
Route::get('/courses-detail/{course_id}', [\App\Http\Controllers\CardController::class, 'getCardsByCourseId']);
Route::get('/courses-list', [\App\Http\Controllers\CourseController::class, 'getAllCourses']);
Route::get('/courses-id/{course_id}', [\App\Http\Controllers\CourseController::class, 'getCourseById']);