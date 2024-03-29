<?php

namespace App\Http\Requests\Exercise;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateExerciseRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'exercise_category_id' => 'required|integer',
            'exercise_type_id' => 'required|integer',
            'coach_id' => '',
            'note' => ''
        ];
    }


    public function attributes(): array
    {
        return [
            'exercise_category_id' => 'category',
            'exercise_type_id' => 'type',
        ];
    }
}
