<?php

namespace App\Http\Controllers\Exercise;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exercise\CreateExerciseRequest;
use App\Models\Exercise\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{


    //TODO some translate transformer for categories


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Exercise::whereNull('coach_id')
            ->orWhere('coach_id', '=', $request->coach_id)
            ->get();
    }

    //only exercises created by specific coach
    public function coachExercises(Request $request) {

        return Exercise::whereCoachId($request->coach_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateExerciseRequest $request)
    {
        $validateData = $request->validated();

        return Exercise::create($validateData)->id;
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
