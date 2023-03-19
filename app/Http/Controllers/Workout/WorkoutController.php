<?php

namespace App\Http\Controllers\Workout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workout\CreateWorkoutRequest;
use App\Models\Coach;
use App\Models\Workout\Workout;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //show workouts
    }


    public function createWorkout(CreateWorkoutRequest $request) {

        $validateData = $request->validated();

        //check if client belongs to coach

        $validateData['workout_started'] = Carbon::now()->format('Y-m-d');


        $workout = Workout::create($validateData);

        return 'Workout added!';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
