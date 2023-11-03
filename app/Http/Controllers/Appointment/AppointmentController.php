<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Http\Services\ExerciseCategoryService;
use App\Models\Appointment;
use App\Models\Coach;
use App\Models\Exercise\ExerciseCategory;
use App\Models\Workout\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{

    protected int $coachID;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->coachID= Auth::user()->id;

            return $next($request);
        });
    }
    public function getAppointments(Request $request)
    {

        $status = $request->input('status');
        $id = $request->input('id');

        $start_date = $request->appointment_start ?? Carbon::now()->startOfDay();

        $end_date = Carbon::now()->endOfDay();

        //this is for some service
        $appointments = Appointment::whereCoachId($this->coachID)
            ->whereBetween('appointment_start', [$start_date, $end_date])
            ->when($status, function ($query) use ($status) {
                return $query->whereIn('status', $status);
            })
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->with('client')
            ->orderBy('appointment_start')
            ->get();

//        $appointments['startedAppointmentsCount'] = $appointments->where('status' , 'In progress')->count();


        return view('web.coach.appointments.appointments', ['appointments' => $appointments]);



    }

    //NEED VALIDATION
    public function createAppointment(Request $request) {
        $clients = $this->getAvailableClientsForAppointment($request);

        return view('web.coach.appointments.create', ['clients' => $clients]);

    }

    public function getAvailableClientsForAppointment(Request $request) {

        $start_date = $request->input('start_date') ?? now();
        $startOfDay = Carbon::parse($start_date)->startOfDay();
        $endOfDay = Carbon::parse($start_date)->endOfDay();

        $clientIds = Appointment::whereBetween('appointment_start', [$startOfDay, $endOfDay])
            ->pluck('client_id');

        $coach = Coach::findOrFail($this->coachID);



        return $coach->clients->whereNotIn('id', $clientIds)->all();


//        return view('web.partial.appointments.create.client-list', ['clients' => $clients]);
    }

    public function storeAppointment(AppointmentRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['coach_id'] = \Auth::user()->id;

        //checking of user, checking of coach

        Appointment::create($validatedData);

        return redirect()->route('appointments.index')->with('success','Appointment created successfully');


    }
    public function startAppointment(ExerciseCategoryService $service, $appointmentID = null) {

        $categories = $service->getExerciseCategories();

        $appointment = Appointment::find($appointmentID);

        //todo find better solution
        if($appointment->coach_id !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        return view('web.coach.appointments.start-appointment', [
            'categories' => $categories,
            'appointmentID' => $appointmentID,
        ]);
    }

    public function test(Request $request) {
        dd($request->q);
    }
}
