<?php

namespace App\Http\Controllers\Exercise;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exercise\CreateExerciseRequest;
use App\Http\Requests\Exercise\UpdateExerciseRequest;
use App\Models\Coach;
use App\Models\Exercise\Exercise;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExerciseController extends Controller
{


    //TODO some translate transformer for categories


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Exercise::whereNull('coach_id')
            ->orWhere('coach_id', '=', $request->input('coach_id'))
            ->get();
    }

    //only exercises created by specific coach
    public function coachExercises(Request $request) {

        return Exercise::whereCoachId($request->input('coach_id'))->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateExerciseRequest $request)
    {
        $validatedData = $request->validated();

        return Exercise::create($validatedData)->id;
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
    public function update(UpdateExerciseRequest $request)
    {
        $validatedData = $request->validated();

        //if is superadmin skip the checking

        // if is shop/gym, check if coach belongs to shop

        $exercise = Exercise::whereId($validatedData['exercise_id'])->firstOrFail();

        $coach = Coach::where('id', 9)->firstOrFail();

        if($exercise->coach_id !== $coach->id) {

            //throw error or json 403
            throw ValidationException::withMessages(['forbidden'=>'You are trying to update exercise which not belong to you!']);
        }

        $exercise->update($validatedData);

        return $exercise->name . " is updated successfully!";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
