<?php

namespace App\Http\Resources\Exercise;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //auth user id
        return [
            'id' => $this->id,
            'name' => $this->name,
            'exercises_count'=> $this->exercises()
                ->where('exercise_category_id', $this->id)
                ->where(function ($query) {
                    $query->where('coach_id', '=', 9)
                        ->orWhereNull('coach_id');
                })->get()->count(),
        ];
    }
}
