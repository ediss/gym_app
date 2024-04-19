<?php

namespace App\Models\Exercise;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseCategory extends Model
{
    use HasFactory;

//    protected $with = ['exercises'];



    public function exercises(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Exercise::class, 'exercise_category_id');
    }

//    public function countOfExercises() {
//        return $this->hasMany(Exercise::class, 'exercise_category_id')
//            ->where('coach_id', 9)
//            ->orWhere('coach_id', null);
//    }
//
//    public function getCountAttribute()
//    {
//        return $this->countOfExercises->count();
//    }


}
