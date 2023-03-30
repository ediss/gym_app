<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\AppointmentCollection;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Coach;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

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

        $coach = $this->coach->where('id', '9')->firstOrFail();

        $clients = $coach->clients()->get();


        echo nl2br("Clients: \n");
        foreach ($clients as $client) {
            echo nl2br($client->name . "/ \n");
        }

        $clientModel = new Client();
        $client = $clientModel->where('id', '11')->firstOrFail();

        $clientCoach = $client->coach()->get();
        echo nl2br("Coach: \n");
        foreach ($clientCoach as $coach) {
            echo  $coach->name . "/ ";
        }


        dd($clientCoach);
        dd($clients);
    }



    public function makeAppointment(AppointmentRequest $request) {
        $validatedData = $request->validated();
        $validatedData['appointment_start'] = $validatedData['start_date'];

        //checking of user, checking of coach

        Appointment::create($validatedData);

        return 'Appointment created successfully';
    }

    //todo make a Request where coach_id is required field
    //todo this probably needs to be in AppointmentController
    public function getAppointments(Request $request): AppointmentCollection
    {

        $coach = $this->coach->whereId('9')->firstOrFail();

        $start_date = $request->appointment_start ?? Carbon::now()->startOfDay();

        //TODO
        //if appointment start is present than end date should be end of the that selected appointment started

        $end_date = Carbon::now()->endOfDay();

        $appointment = Appointment::whereCoachId($coach->id)
            ->whereBetween('appointment_start', [$start_date, $end_date])
            ->with('clients')
            ->get();

      return new AppointmentCollection($appointment);

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
