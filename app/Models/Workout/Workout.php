<?php

namespace App\Models\Workout;

use App\Models\Exercise\Exercise;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workout extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['coach_id', 'client_id', 'exercise_id', 'reps', 'weight', 'distance', 'appointment_id'];
    /**
     * for migration, we will need:
     *
     *  coach_id,
     *  client_id,
     *  exercise_id,
     *  weight,
     *  reps,
     *  date_of_workout/session
     * ///////////////////////////////////////
     * ABOVE IS FOR THE 1ST PHASE
     *  time, //like minutes/seconds,
     *  distance,
     *
     */

    public function exercise(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }
}
