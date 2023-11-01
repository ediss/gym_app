<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends User
{
    use HasFactory, SoftDeletes;

    protected $table = 'users';

    public function coach(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Coach::class, 'client_coach', 'client_id', 'id');
    }

    public function appointment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Appointment::class, 'client_id', 'id');
    }

}
