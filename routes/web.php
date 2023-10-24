<?php

use App\Http\Controllers\Exercise\ExerciseController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Coach\CoachController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/{any}', function () {
//    return view('welcome');
//})->where('any', '.*');


//Route::get('{any}', function () {
//    return view('welcome');
//})->where('any', '.*');

Route::group(['prefix' => 'coach'], function() {
    Route::get('/clients', [CoachController::class, 'index']);

    Route::get('/appointments', [CoachController::class, 'getAppointments']);

    Route::get('/start-appointment/{id}', [AppointmentController::class, 'startAppointment'])->name('appointment.start');

    Route::get('/search-exercises', [ExerciseController::class, 'index']);

    Route::get('/category-exercises/{id}', [ExerciseController::class, 'categoryExercises']);




});


