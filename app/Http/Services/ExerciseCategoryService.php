<?php
namespace App\Http\Services;


use App\Models\Exercise\ExerciseCategory;

class ExerciseCategoryService
{
    public function getCategoriesWithExercisesForCoach($coachID, $categoryID = null) {
        $categories =  ExerciseCategory::with(['exercises' => function ($query) use ($coachID) {
            $query->where('coach_id', $coachID)
                ->orWhereNull('coach_id');
        }]);

        if($categoryID) {
            $categories->where('id', $categoryID);
        }

        return $categories->get();
    }
}
