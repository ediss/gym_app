<?php

namespace App\Http\Controllers\Exercise;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exercise\CreateExerciseRequest;
use App\Http\Requests\Exercise\UpdateExerciseRequest;
use App\Http\Resources\Exercise\ExerciseCategoryResource;
use App\Http\Resources\Exercise\ExerciseResource;
use App\Http\Resources\Exercise\ExerciseTypeResource;
use App\Http\Services\ExerciseCategoryService;
use App\Models\Appointment;
use App\Models\Coach;
use App\Models\Exercise\Exercise;
use App\Models\Exercise\ExerciseCategory;
use App\Models\Exercise\ExerciseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ExerciseController extends Controller
{

    private int $coachID;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->coachID= Auth::user()->id;

            return $next($request);
        });
    }

    //this should be in show method?

    public function getExerciseByID($exercise_id): ExerciseResource
    {
        $exercise =  Exercise::whereId($exercise_id)->first();
        return new ExerciseResource($exercise);
    }


   public function index(ExerciseCategoryService $service) {

       $categories = $service->getExerciseCategories();
       $exercises = Exercise::where('coach_id', $this->coachID)
           ->orWhereNull('coach_id')->get();


       return view('web.coach.exercises.exercises', [
           'exercises' => $exercises,
           'categories' => $categories
       ]);
   }
    public function searchExercises(Request $request)
    {
        $usageType = $request->input('usageType');
        $search = $request->input('q');
        $appointment = $request->input('appointment');
        $coachID = $this->coachID;

        $exercises = Exercise::where('name', 'like', $search . '%')
            ->where(function ($query) use($coachID){
                $query->where('coach_id', '=', $coachID)
                    ->orWhereNull('coach_id');
            })->get();



        return view('web.partial.exercises', [
            'exercises' => $exercises,
            'usageType' => $usageType,
            'appointmentID' => $appointment
        ]);
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

        $validatedData['coach_id'] = $this->coachID;

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

        // only first because now UpdateExerciseRequest is updated check it

        // $exercise = Exercise::whereId($validatedData['exercise_id'])->firstOrFail();
        $exercise = Exercise::whereId($request->exercise_id)->first();

        $coach = Coach::where('id', $this->coachID)->firstOrFail();

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

        $exercise = Exercise::whereId($request->input('exercise_id'))->firstOrFail();

        //if is superadmin skip the checking

        // if is shop/gym, check if coach belongs to shop

//        $coach = Coach::where('id', $this->coachID)->firstOrFail();

        if($exercise->coach_id !== $this->coachID) {

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


    public function categoryExercises(Request $request)
    {

        $categoryID = $request->input('categoryID');
        $usageType = $request->input('usageType');
        $appointmentID = $request->input('appointmentID');
        $coachID = $this->coachID;

        $exercises = Exercise::where('exercise_category_id', $categoryID)
                ->where(function ($q) use($coachID){
                    $q->where('coach_id', '=', $coachID)
                        ->orWhereNull('coach_id');
                })->get();


        return view('web.partial.exercises', [
            'exercises' => $exercises,
            'usageType' => $usageType,
            'appointmentID' => $appointmentID
        ]);
    }


    public function types(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ExerciseTypeResource::collection(ExerciseType::all());
    }


    public function test() {
        return 'test prosao';
    }
}
