<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Http\Resources\AppointmentCollection;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\Client\ClientResource;
use App\Models\Appointment;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CoachController extends Controller
{

    private $coach;

    public function __construct(Coach $coach)
    {
        $this->coach = $coach;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //this is home page for coach

        //@todo get id from auth facade

        $coach = $this->coach->where('id', '9')->firstOrFail();

        $clients = $coach->clients()->get();

        return view('web.coach.clients', ['clients' => $clients]);


    }



    // create appointment controller

    public function makeAppointment(AppointmentRequest $request) {
        $validatedData = $request->validated();


        $validatedData['appointment_start'] = Carbon::parse($validatedData['start_date']);

        //hardcoded for now...
        $validatedData['coach_id'] = 9;

        //checking of user, checking of coach

        Appointment::create($validatedData);

        return 'Appointment created successfully';
    }

    //todo make a Request where coach_id is required field
    //todo this probably needs to be in AppointmentController


    public function getAppointmentByID(Request $request) {

        $id = $request->appointment_id;

        $appointment = Appointment::whereId($id)
            ->with('clients')
            ->first();

        //return new AppointmentCollection($appointment);
        //return new AppointmentCollection($appointments);
        return new AppointmentResource($appointment);
    }

    public function getAppointments(Request $request)
    {

        $status = $request->status;
        $id = $request->id;


        $coach = $this->coach->whereId('9')->firstOrFail();

        $start_date = $request->appointment_start ?? Carbon::now()->startOfDay();

        //TODO
        //if appointment start is present than end date should be end of the that selected appointment started

        $end_date = Carbon::now()->endOfDay();

        $appointments = Appointment::whereCoachId($coach->id)
            ->whereBetween('appointment_start', [$start_date, $end_date])
            ->when($status, function ($query) use ($status) {
                return $query->whereIn('status', $status);
            })
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->with('clients')
            ->get();

        return view('web.coach.appointments.todays', ['appointments' => $appointments]);



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
