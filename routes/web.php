<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\Workout\WorkoutController;
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


Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('/login', 'Auth\LoginController@login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'super-admin', 'middleware' => ['auth', 'role:SuperAdmin']], function() {

    Route::get('/coaches', [SuperAdminController::class, 'getCoaches'])->name('superadmin.coaches');

});

Route::group(['prefix' => 'coach', 'middleware' => ['auth', 'role:Coach']], function() {
    Route::get('/clients', [CoachController::class, 'index'])->name('coach.clients');

    Route::get('/client-create', [ClientController::class, 'createClientForm'])->name('client.create-client-form');
    Route::post('/client-create', [ClientController::class, 'store'])->name('client.store');

    Route::get('/appointments', [AppointmentController::class, 'getAppointments'])->name('appointments.index');

    Route::get('/appointment-create', [AppointmentController::class, 'createAppointment'])->name('appointment.create');

    Route::post('/get-available-clients', [AppointmentController::class, 'getAvailableClientsForAppointment'])->name('appointment.available-clients');

    Route::post('/appointment-store', [AppointmentController::class, 'storeAppointment'])->name('appointment.store');


    Route::get('/start-appointment/{id}', [AppointmentController::class, 'startAppointment'])->name('appointment.start');


    //EXERCISES
    Route::get('/exercises',                [ExerciseController::class, 'index'])           ->name('exercises.index');
    Route::get('/exercise-create',          [ExerciseController::class, 'createExercise'])  ->name('exercise.create');
    Route::post('/exercise-store',          [ExerciseController::class, 'store'])           ->name('exercise.store');
    Route::get('/search-exercises',         [ExerciseController::class, 'searchExercises']);
    Route::post('/category-exercises',      [ExerciseController::class, 'categoryExercises']);

    Route::get('test', [ExerciseController::class, 'test'])->name('exercise.crud');

    //WORKOUTS
    Route::post('/workout/create', [WorkoutController::class, 'create'])->name('workout.create');
    Route::post('/workout/store', [WorkoutController::class, 'store'])->name('workout.store');

    Route::post('/workout/update/{id}', [WorkoutController::class, 'update'])->name('workout.update');

    Route::post('/appointment-workout', [WorkoutController::class, 'getWorkoutsByAppointmentId'])->name('appointment.workouts');



});




Route::get('/logout', function () {
    Auth::logout(); // Logs the user out

    return redirect()->route('login'); // Redirect to the login page or any other page you prefer
})->name('logout');



