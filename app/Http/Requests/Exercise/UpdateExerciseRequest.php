<?php

namespace App\Http\Requests\Exercise;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateExerciseRequest extends FormRequest
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
            'name' => 'required|string',
            'exercise_category_id' => 'required|integer',
            'exercise_type_id' => 'required|integer',
            'exercise_id' => [
                'required',
                Rule::exists('exercises', 'id')
                    ->where('coach_id',Auth::user()->id),
            ],
        ];
    }
}
