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

        return new ExerciseHistoryCollection($exerciseHistory->groupBy('workout_started'));

    }

    //need refactor
    public function create(Appointment $appointment, Exercise $exercise)
    {

        $exerciseType = ExerciseType::find($exercise->exercise_type_id);

        $workouts = $this->getClientWorkoutByAppointmentAndExerciseId($appointment->id, $exercise->id);

        $exerciseHistory = $this->getExerciseHistory($appointment->client_id, $exercise->id);

        $lastRecord = $this->getLastWorkoutRecord($appointment->client_id, $exercise->id);


        return view('web.coach.workouts.create', [
            'appointment' => $appointment,
            'exercise' => $exercise,
            'exerciseTypeName' => $exerciseType->name,
            'workouts' => $workouts,
            'exerciseHistory' => $exerciseHistory,
            'lastRecord' => $lastRecord,
        ]);

    }

    public function store(CreateWorkoutRequest $request)
    {

        $existingRecord = Workout::where('appointment_id', $request->appointment_id)->first();

        //doesnt belong here
        if (!$existingRecord) {
            $appointment = Appointment::find($request->appointment_id);

            $appointment->status = 'In progress';

            $appointment->save();
        }

        Workout::create($request->all());

        // Check if a record with a specific condition already exists

        $workouts = Workout::where('appointment_id', $request->appointment_id)
            ->where('exercise_id', $request->exercise_id)
            ->get();

        return view('web.workout.exercises', ['workouts' => $workouts]);
    }

    public function update(CreateWorkoutRequest $request, Workout $workout)
    {
        $workout->update($request->all());

        $workouts = Workout::where('appointment_id', $request->appointment_id)
            ->where('exercise_id', $request->exercise_id)
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
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteWorkoutRequest $request, Workout $workout)
    {

        $workout->delete();

        $workouts = Workout::where('appointment_id', $request->appointment_id)
            ->where('exercise_id', $request->exercise_id)
            ->get();

        return redirect()->back()->with(['workouts' => $workouts]);
    }

    private function getClientWorkoutByAppointmentAndExerciseId($appointmentId, $exerciseId)
    {
        return Workout::where('appointment_id', $appointmentId)
            ->where('exercise_id', $exerciseId)
            ->get();
    }

    private function getExerciseHistory($clientId, $exerciseId)
    {
        return Workout::where('client_id', $clientId)
            ->where('exercise_id', $exerciseId)
            ->orderBy('appointment_id', 'DESC')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->format('j. F Y');
            });
    }

    private function getLastWorkoutRecord($clientId, $exerciseId)
    {
        return Workout::where('client_id', $clientId)
            ->where('exercise_id', $exerciseId)
            ->latest()
            ->first();
    }

    public function getWorkoutsByAppointmentId(Request $request)
    {

        $workouts = Workout::where('appointment_id', $request->input('appointmentId'))
            ->with('exercise') // Eager load the exercise relationship
            ->get();

        return view('web.workout.appointment-workouts', [
            'workouts' => $workouts->groupBy('exercise.name'),
            'test' => true
        ]);

    }
}
