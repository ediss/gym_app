<?php

namespace App\Http\Requests\Appointment;

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
            'appointment_start' => Carbon::parse($this->start_date . $this->appointment_start),
            'appointment_end' => Carbon::parse($this->start_date . $this->appointment_end)

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
            'start_date'=> 'required|date',
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
}
