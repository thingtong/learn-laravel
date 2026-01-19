<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\CourseController;
use App\Http\Controllers\Web\LessonController;
use App\Http\Controllers\Web\QuizController;

Route::get('/register', [AuthWebController::class, 'showRegister']);
Route::post('/register', [AuthWebController::class, 'register']);

Route::get('/login', [AuthWebController::class, 'showLogin']);
Route::post('/login', [AuthWebController::class, 'login']);

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::middleware(['auth'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);

    Route::get('/lessons/{id}', [LessonController::class, 'show']);
    Route::post('/lessons/{id}/complete', [LessonController::class, 'complete']);

    Route::get('/quiz/{courseId}/start', [QuizController::class, 'start']);
    Route::post('/quiz/{quizId}/submit', [QuizController::class, 'submit']);

});


#require __DIR__.'/auth.php';
