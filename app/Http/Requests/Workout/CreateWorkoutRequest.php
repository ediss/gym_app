<?php

namespace App\Http\Requests\Workout;

use App\Models\Exercise\Exercise;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateWorkoutRequest extends FormRequest
{
    const REPS_TYPES = [1, 5, 8, 9];
    public const WEIGHT_TYPES = [2, 5, 6, 7];
    const TIME_TYPES = [3, 7, 9, 10];
    const DISTANCE_TYPES = [4, 6, 8, 10];

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
        $exercise = Exercise::whereId($this->exercise_id)->first();

        $exercise_type = $exercise->exercise_type_id;

        return [
            'coach_id' => 'required|integer',
            'client_id'=> 'required|integer',
            'exercise_id'=> 'required|integer',
            'appointment_id' => 'required|integer',
            'reps'      => Rule::requiredIf(in_array($exercise_type, self::REPS_TYPES, true)),
            'weight'    => Rule::requiredIf(in_array($exercise_type, self::WEIGHT_TYPES, true)),
            'time'      => Rule::requiredIf(in_array($exercise_type, self::TIME_TYPES, true)),
            'distance'  => Rule::requiredIf(in_array($exercise_type, self::DISTANCE_TYPES, true)),

        ];
    }

}
