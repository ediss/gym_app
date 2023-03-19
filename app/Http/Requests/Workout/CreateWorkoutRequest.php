<?php

namespace App\Http\Requests\Workout;

use Illuminate\Foundation\Http\FormRequest;

class CreateWorkoutRequest extends FormRequest
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
            'coach_id' => 'required|integer',
            'client_id'=> 'required|integer',
            'exercise_id'=> 'required|integer',
            'workout_started' => '',
            'reps' => '', //requiredif
            'weight' => '', //requiredif
            'time' => '', //requiredif
            'distance' => '', //requiredif

        ];
    }
}
