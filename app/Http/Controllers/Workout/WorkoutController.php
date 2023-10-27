<?php

namespace App\Http\Controllers\Workout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exercise\ShowExerciseHistoryRequest;
use App\Http\Requests\Workout\CreateWorkoutRequest;
use App\Http\Requests\Workout\DeleteWorkoutRequest;
use App\Http\Requests\Workout\ShowWorkoutRequest;
use App\Http\Resources\Exercise\ExerciseHistoryCollection;
use App\Models\Appointment;
use App\Models\Exercise\Exercise;
use App\Models\Exercise\ExerciseType;
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

    public function getClientWorkout(ShowWorkoutRequest $request)
    {

        $validatedData = $request->validated();

        $workout = Workout::whereClientId($validatedData['client_id']);

        if (isset($validatedData['date'])) {
            $workout->where('workout_started', $validatedData['date']);
        }

        return $workout->get();
    }

    public function getClientExerciseHistory(ShowExerciseHistoryRequest $request)
    {
        $validatedData = $request->validated();


        $exerciseHistory = Workout::whereClientId($validatedData['client_id'])
            ->whereExerciseId($validatedData['exercise_id'])
            ->orderBy('workout_started', 'desc')
            ->get();

//        return  new ExerciseHistoryCollection($exerciseHistory->groupBy('workout_started'));
        return  new ExerciseHistoryCollection($exerciseHistory->groupBy('workout_started'));


    }
    public function createWorkout(CreateWorkoutRequest $request) {




        $validatedData = $request->validated();

        //check if client belongs to coach

        //add workout note in db table

//        $validatedData['workout_started'] = Carbon::now()->format('Y-m-d');



        $workout = Workout::create($validatedData);


        //@todo return proper response ( Response::HTTP_CREATED)

        return 'Workout added!';
    }


    public function create(Request $request) {
        $appointmentID = $request->input('appointmentID');
        $exerciseID = $request->input('exercise_id');


        $appointment = Appointment::find($appointmentID);


        $exercise = Exercise::find($exerciseID);

        $exerciseType = ExerciseType::find($exercise->exercise_type_id);

        $workouts = Workout::where('appointment_id', $appointmentID)
            ->where('exercise_id', $exerciseID)
            ->get();


        return view('web.coach.workouts.create', [
            'appointment' => $appointment,
            'exercise' => $exercise,
            'exerciseTypeName' => $exerciseType->name,
            'workouts' => $workouts
        ]);

    }


    public function store(CreateWorkoutRequest $request)
    {

        $validatedData = $request->validated();

        Workout::create($validatedData);

        $workouts = Workout::where('appointment_id', $validatedData['appointment_id'])
            ->where('exercise_id', $validatedData['exercise_id'])
            ->get();

        return view('web.workout.exercises', ['workouts' => $workouts]);
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
    public function destroy(DeleteWorkoutRequest $request)
    {
        $validatedData = $request->validated();

        $deleteWorkout = Workout::findOrFail($validatedData['workout_id'])
            ->delete();

        if (!$deleteWorkout) {
            return "Remove workout error";
        }

        //@todo return proper response ( Response::HTTP_NO_CONTENT)

        return 'Workout removed succesfully!';
    }

    public function getWorkoutByAppointmentAndExerciseId($appointment_id,  $exercise_id)
    {
        $workouts = Workout::where('appointment_id', $appointment_id)
                ->where('exercise_id', $exercise_id)
                ->get();

        return view('web.workout.exercises', ['workouts' => $workouts]);
    }
}
