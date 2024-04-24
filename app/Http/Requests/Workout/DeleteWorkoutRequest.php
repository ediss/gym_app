<?php

namespace App\Http\Requests\Workout;

use Illuminate\Foundation\Http\FormRequest;

class DeleteWorkoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'workout_id' => 'required|integer',
            'coach_id' => 'required|integer',
            'client_id'=> 'required|integer',
            'exercise_id'=> 'required|integer',
            'appointment_id' => 'required|integer',
        ];
    }
}
