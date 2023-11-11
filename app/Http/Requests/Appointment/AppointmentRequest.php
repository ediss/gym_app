<?php

namespace App\Http\Requests\Appointment;

use App\Models\Appointment;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'appointment_start' => Carbon::parse($this->input('start_date') . $this->input('appointment_start')),
            'appointment_end' => Carbon::parse($this->input('start_date') . $this->input('appointment_end'))

        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
//            'coach_id' => 'required|integer',
            'client_id' => 'required|integer',
            'start_date' => 'required|date',
            'appointment_start' => 'required|unique:appointments',
            'appointment_end' => 'required|unique:appointments|after:appointment_start',
            'status' => '',
        ];
    }


    public function messages(): array
    {
        return [
            'appointment_start.required' => 'The start time is required.',
            'appointment_start.unique' => 'The start time has already been taken.',
            'appointment_start.date' => 'The start time must be a valid date.',
            'appointment_end.required' => 'The finish time is required.',
            'appointment_end.date' => 'The finish time must be a valid date.',
            'appointment_end.after' => 'The finish time must be after the start time.',
            'appointment_end.unique' => 'The finish time has already been taken.',
        ];
    }

    public function withValidator($validator): void
    {


        $validator->after(function ($validator) {
            $appointment_start = $this->input('appointment_start');
            $appointment_end = $this->input('appointment_end');
            $client_id = $this->input('client_id');
            $start_date = Carbon::parse($this->input('start_date'))->startOfDay();
            $end_date = Carbon::parse($this->input('start_date'))->endOfDay();

            // Check if the time slot is already booked

//            $isSlotBooked = Appointment::where(function ($query) use ($appointment_start, $appointment_end) {
//                $query->where(function ($query) use ($appointment_start, $appointment_end) {
//                    $query->where('appointment_start', '<', $appointment_start)->where('appointment_end', '>', $appointment_start);
//                })->orWhere(function ($query) use ($appointment_start, $appointment_end) {
//                    $query->where('appointment_start', '<', $appointment_end)->where('appointment_end', '>', $appointment_end);
//                })->orWhere(function ($query) use ($appointment_start, $appointment_end) {
//                    $query->where('appointment_start', '>=', $appointment_start)->where('appointment_end', '<=', $appointment_end);
//                });
//            })->exists();
            $isSlotBooked = Appointment::where(function ($query) use ($appointment_start, $appointment_end) {
                $query->where('appointment_start', '<', $appointment_end)
                    ->where('appointment_end', '>', $appointment_start);
            })->exists();

            // Check if an appointment with the same start_date and client_id exists
            $existingAppointment = Appointment::whereBetween('appointment_start', [$start_date, $end_date])
                ->where('client_id', $client_id)
                ->first();

            if ($existingAppointment) {
                $validator->errors()->add('client_id', 'The selected date is already booked for this client.');
            }

            if ($isSlotBooked) {
                $validator->errors()->add('appointment_start', 'The selected time slot is already booked.');
            }
        });
    }
}
