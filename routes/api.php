<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;

// === ROTAS PÚBLICAS ===
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// === ROTAS PROTEGIDAS ===
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::apiResource('workouts', WorkoutController::class);

    Route::get('/workouts/{workout}/exercises', [ExerciseController::class, 'index']);
    Route::post('/workouts/{workout}/exercises', [ExerciseController::class, 'store']);
    Route::put('/exercises/{exercise}', [ExerciseController::class, 'update']);
    Route::delete('/exercises/{exercise}', [ExerciseController::class, 'destroy']);
});