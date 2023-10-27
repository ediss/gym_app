<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Http\Services\ExerciseCategoryService;
use App\Models\Appointment;
use App\Models\Coach;
use App\Models\Exercise\ExerciseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AppointmentController extends Controller
{

    public function getAppointments(Request $request)
    {

        $status = $request->status;
        $id = $request->id;


        $coach = Coach::where('id','9')->firstOrFail();

        $start_date = $request->appointment_start ?? Carbon::now()->startOfDay();

        $end_date = Carbon::now()->endOfDay();

        $appointments = Appointment::whereCoachId($coach->id)
            ->whereBetween('appointment_start', [$start_date, $end_date])
            ->when($status, function ($query) use ($status) {
                return $query->whereIn('status', $status);
            })
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->with('client')
            ->get();

        return view('web.coach.appointments.appointments', ['appointments' => $appointments]);



    }

    public function createAppointment() {

        $coach = Coach::where('id', 9)->with('clients')->firstOrFail();

        $clients = $coach->clients;

        return view('web.coach.appointments.create', ['clients' => $clients]);

    }

    public function storeAppointment(AppointmentRequest $request) {
        $validatedData = $request->validated();


        $validatedData['appointment_start'] =
            Carbon::parse($validatedData['start_date'] . $validatedData['start_time']);

        $validatedData['appointment_end'] =
            Carbon::parse($validatedData['start_date'] . $validatedData['end_time']);


        //hardcoded for now...
        $validatedData['coach_id'] = 9;

        //checking of user, checking of coach

        Appointment::create($validatedData);

        return redirect()->route('appointments.index')->with('success','Appointment created successfully');


    }
    public function startAppointment(ExerciseCategoryService $service, $appointmentID = null) {

        $categories = $service->getExerciseCategories();
        return view('web.coach.appointments.start-appointment', [
            'categories' => $categories,
            'appointmentID' => $appointmentID,
        ]);
    }

    public function test(Request $request) {
        dd($request->q);
    }
}
