<?php
namespace App\Http\Services;


use App\Models\Exercise\ExerciseCategory;
use Illuminate\Support\Facades\Auth;

class ExerciseCategoryService
{
    public function getExerciseCategories() {
        $exercisesCategories = ExerciseCategory::all();

        return $exercisesCategories->map(function ($category) {
            $category->exercises_count =
                $category->exercises()->where('exercise_category_id', $category->id)
                    ->where(function ($q) {
                        $q->where('coach_id', Auth::user()->id)
                            ->orWhere('coach_id', null);
                    })->get()->count();

            return $category;
        });
    }
}
