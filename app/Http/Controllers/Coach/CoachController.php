<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{

    private Coach $coach;
    private int $coachID;
    public function __construct(Coach $coach)
    {
        $this->coach = $coach;

        $this->middleware(function ($request, $next) {
            $this->coachID= Auth::user()->id;

            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //this is home page for coach

        //@todo get id from auth facade

        $coach = $this->coach->where('id', $this->coachID)->firstOrFail();


        $clients = $coach->clients()->get();


        return view('web.coach.clients', ['clients' => $clients]);


    }

    public function getAppointmentByID(Request $request) {

        $id = $request->appointment_id;

        $appointment = Appointment::whereId($id)
            ->with('clients')
            ->first();

        return new AppointmentResource($appointment);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //here we can store coach direct from admin panel
        //admin panel can be for super admin (me :D ) or shop/gym
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get all coach data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update coach data
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
