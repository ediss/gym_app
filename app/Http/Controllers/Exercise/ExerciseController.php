<?php

namespace App\Http\Controllers\Exercise;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exercise\CreateExerciseRequest;
use App\Http\Requests\Exercise\UpdateExerciseRequest;
use App\Http\Resources\Exercise\ExerciseCategoryResource;
use App\Http\Resources\Exercise\ExerciseResource;
use App\Http\Resources\Exercise\ExerciseTypeResource;
use App\Http\Services\ExerciseCategoryService;
use App\Models\Coach;
use App\Models\Exercise\Exercise;
use App\Models\Exercise\ExerciseCategory;
use App\Models\Exercise\ExerciseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ExerciseController extends Controller
{

    //this should be in show method?

    public function getExerciseByID($exercise_id): ExerciseResource
    {
        $exercise =  Exercise::whereId($exercise_id)->first();
        return new ExerciseResource($exercise);
    }


   public function index(ExerciseCategoryService $service) {

       $categories = $service->getExerciseCategories();
       $exercises = Exercise::where('coach_id', 9)
           ->orWhereNull('coach_id')->get();


       return view('web.coach.exercises.exercises', [
           'exercises' => $exercises,
           'categories' => $categories
       ]);
   }
    public function searchExercises(Request $request)
    {
        //$coachID = $request->input('coach_id');
        $coachID = 9;

        $exercises = Exercise::where('name', 'like', $request->q . '%')
            ->where(function ($query) use($coachID){
                $query->where('coach_id', '=', $coachID)
                    ->orWhereNull('coach_id');
            })->get();

        return view('web.partial.exercises', ['exercises' => $exercises]);
    }

    //only exercises created by specific coach
    public function coachExercises(Request $request) {

        return Exercise::whereCoachId($request->input('coach_id'))->get();
    }

    public function createExercise() {

        $exercisesCategories = ExerciseCategory::all();
        $exercisesTypes = ExerciseType::all();

        return view('web.coach.exercises.create', [
            'categories' => $exercisesCategories,
            'types' => $exercisesTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateExerciseRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['coach_id'] = 9;

        $exercise = Exercise::create($validatedData);



        return redirect()->route('exercises.index')->with('success','Exercise '. $exercise->name .' created successfully');

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

        // only first becasue now UpdateExerciseRequest is updated check it

        // $exercise = Exercise::whereId($validatedData['exercise_id'])->firstOrFail();
        $exercise = Exercise::whereId($request->exercise_id)->first();

        $coach = Coach::where('id', 9)->firstOrFail();

//        if($exercise->coach_id !== $coach->id) {
//
//            //throw error or json 403
//            throw ValidationException::withMessages(['forbidden'=>'You are trying to update exercise which not belong to you!']);
//        }

        $exercise->update($validatedData);

        return $exercise->name . " is updated successfully!";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $exercise = Exercise::whereId($request->exercise_id)->firstOrFail();

        //if is superadmin skip the checking

        // if is shop/gym, check if coach belongs to shop

        $coach = Coach::where('id', 9)->firstOrFail();

        if($exercise->coach_id !== $coach->id) {

            //throw error or json 403
            throw ValidationException::withMessages(['forbidden'=>'You are trying to DELETE exercise which not belong to you!']);
        }

        // DECIDE IF EXERCISE SHOULD BE DELETED/SOFTDELETED OR DISABLED

        //PITANJA ZA TRENERE

        // DA LI ZELITE DA VEZBA BUDE OBRISANA => NEMA UVIDA U ISTORIJU VEZBE GUBE SE SVI PODACI GDE GOD SE VEZBA PROVUKLA

        // ILI DA SE DISABLUJE => NE MOZE SE VISE KORISTITI PRILIKOM PRAVLJENJA TRENINGA ALI MOZE SE UCI U ISTORIJU KROZ KLIJENTA
    }

    public function categories(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ExerciseCategoryResource::collection(ExerciseCategory::all());
    }

    public function categoryExercises($category_id = null)
    {
        $coachID = 9;
        $exercises = Exercise::where('exercise_category_id', $category_id)
                ->where(function ($q) use($coachID){
                    $q->where('coach_id', '=', $coachID)
                        ->orWhereNull('coach_id');
                })->get();


        return view('web.partial.exercises', ['exercises' => $exercises]);
    }


    public function types(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ExerciseTypeResource::collection(ExerciseType::all());
    }
}
