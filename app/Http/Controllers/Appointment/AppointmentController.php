<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Models\Exercise\ExerciseCategory;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function startAppointment($appointmentID) {


        $exercisesCategories = ExerciseCategory::all();


        $categories = $exercisesCategories->map(function ($category) {
             $category->exercises_count =
                 $category->exercises()->where('exercise_category_id', $category->id)
                     ->where(function ($q) {
                     $q->where('coach_id', 9)
                         ->orWhere('coach_id', null);
                 })->get()->count();

            return $category;
        });



        return view('web.coach.appointments.start-appointment', ['categories' => $categories]);
    }

    public function test(Request $request) {
        dd($request->q);
    }
}
