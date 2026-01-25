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

    // ===== Courses =====
    Route::get('/courses', [CourseController::class, 'index']);
   
    // Route::get('/courses/create', [CourseController::class, 'create']);
    // //Route::post('/courses', [CourseController::class, 'store']);
    // Route::post('/courses/store', [CourseController::class, 'store']);
    
    // Route::get('/courses/create', [CourseController::class, 'create'])
    //     ->name('courses.create');

    // Route::post('/courses/store', [CourseController::class, 'store'])
    //     ->name('courses.store');

    Route::resource('courses', CourseController::class);

    Route::get('/courses/{id}', [CourseController::class, 'show'])
        ->whereNumber('id');

    // Route::get('/lessons/{id}', [LessonController::class, 'show']);
    // Route::post('/lessons/{id}/complete', [LessonController::class, 'complete']);

    // ===== Lessons =====
    Route::get('/lessons/{id}', [LessonController::class, 'show'])
        ->whereNumber('id');
    Route::post('/lessons/{id}/complete', [LessonController::class, 'complete'])
        ->whereNumber('id');

    // ===== Quiz =====
    
    Route::get('/quiz/{courseId}/start', [QuizController::class, 'start'])
        ->whereNumber('courseId');
    Route::post('/quiz/{quizId}/submit', [QuizController::class, 'submit'])
        ->whereNumber('quizId');
});


#require __DIR__.'/auth.php';
