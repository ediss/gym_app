<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Client\ClientController;
use App\Http\Controllers\Api\Coach\CoachController;
use App\Http\Controllers\Api\Exercise\ExerciseController;
use App\Http\Controllers\Api\Workout\WorkoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'coach', 'middleware' => ['auth:sanctum']], function(){
    Route::post('/create-client', [ClientController::class, 'store']);

    Route::post('/create-exercise', [ExerciseController::class, 'store']);
    Route::post('/update-exercise', [ExerciseController::class, 'update']);
    Route::post('/show-coach-exercise', [ExerciseController::class, 'coachExercises']);
    Route::post('/show-all-exercise', [ExerciseController::class, 'index']);

    Route::post('/make-appointment', [CoachController::class, 'makeAppointment']);

    Route::post('/get-appointments', [CoachController::class, 'getAppointments']);

    Route::post('/create-workout', [WorkoutController::class, 'createWorkout']);

//    Route::get('/show-client', [CoachController::class, 'index']);

    Route::post('/delete-client', [ClientController::class, 'destroy']);
    Route::post('/delete-workout', [WorkoutController::class, 'destroy']);
});

Route::post('/client-workout', [WorkoutController::class, 'getClientWorkout']);

Route::post('/client-exercise-history', [WorkoutController::class, 'getClientExerciseHistory']);

//practice
Route::post('/appointments', [CoachController::class, 'getAppointments']);


Route::get('/get-clients', [CoachController::class, 'index']);

Route::post('/make-appointment', [CoachController::class, 'makeAppointment']);

