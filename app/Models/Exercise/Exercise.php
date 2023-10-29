<?php

namespace App\Models\Exercise;

use App\Models\Coach;
use App\Models\Workout\Workout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
//    use HasFactory, SoftDeletes;
    use HasFactory;
    protected $fillable = ['name', 'exercise_category_id', 'note', 'exercise_type_id', 'coach_id'];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExerciseCategory::class, 'exercise_category_id');
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ExerciseType::class, 'id', 'exercise_type_id');
    }

    public function coach() {
        return $this->belongsTo(Coach::class);
    }

    public function workouts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Workout::class, 'exercise_id');
    }
}
