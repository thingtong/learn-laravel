<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthWebController;

Route::get('/register', [AuthWebController::class, 'showRegister']);
Route::post('/register', [AuthWebController::class, 'register']);

Route::get('/login', [AuthWebController::class, 'showLogin']);
Route::post('/login', [AuthWebController::class, 'login']);

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

#require __DIR__.'/auth.php';
