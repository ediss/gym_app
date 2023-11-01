<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coach extends User
{
    use HasFactory, SoftDeletes;

    protected $table = 'users';



    public function clients(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
       return $this->belongsToMany(Client::class, 'client_coach', 'coach_id', 'client_id')->withTimestamps();

    }




    public function appointments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Appointment::class, 'coach_id', 'id');
    }
}
