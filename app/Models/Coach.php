<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coach extends User
{
    use HasFactory, SoftDeletes;

    protected $table = 'users';


    public const COACH_ROLE_ID = 4;

    protected static function boot(): void
    {
        parent::boot();

        // Apply a global scope to retrieve only coaches
        static::addGlobalScope('coach', function (Builder $builder) {
            $builder->where('role_id', self::COACH_ROLE_ID);
        });
    }
    public function clients(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
       return $this->belongsToMany(Client::class, 'client_coach', 'coach_id', 'client_id')->withTimestamps();

    }

    public function appointments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Appointment::class, 'coach_id', 'id');
    }


//    public function coachProfile(): \Illuminate\Database\Eloquent\Relations\HasOne
//    {
//        return $this->hasOne(CoachProfile::class);
//    }
}
