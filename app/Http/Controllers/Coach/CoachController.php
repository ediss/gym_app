<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Coach;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class CoachController extends Controller
{
    const CLIENT_ROLE = 3;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //this is home page for coach
        $coachModel = new Coach();

        $coach = $coachModel->where('id', '9')->firstOrFail();



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

    public function createClient(CreateUserRequest $request) {

        $validateData = $request->validated();

        if($validateData['role_id'] != self::CLIENT_ROLE) {
            throw ValidationException::withMessages(['role'=>'You are trying to create user which is not client!']);
        }

        $coachModel = new Coach();

        $coach = $coachModel->where('id', '9')->firstOrFail();

        $client = Client::create($validateData);


        $coach->clients()->attach($client);


//        $this->assignClientToCoach($client_id);

        return 'saved';

    }

    public function makeAppointment(AppointmentRequest $request) {
        $validateData = $request->validated();
        $validateData['appointment_start'] = $validateData['start_date'];

        //checking of user, checking of coach

        Appointment::create($validateData);

        return 'Appointment created successfully';
    }

    public function getAppointments(Request $request) {

        $coach = Coach::whereId('9')->firstOrFail();

        $start_date = Carbon::now()->startOfDay();
        $end_date = Carbon::now()->endOfDay();

        $test = Appointment::whereCoachId($coach->id)->whereBetween('appointment_start', [$start_date, $end_date])->get();

        dd(collect($test));

        dd($test);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    //TODO check if this should be in Model
    private function assignClientToCoach($client_id) {


    }
}
