<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['coach_id', 'client_id', 'appointment_start', 'appointment_end', 'status'];

    public function client(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    public function coach(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'id', 'coach_id');
    }

    protected $casts = [
        'appointment_start'  => 'datetime:Y-m-d H:i:s',
        'appointment_end' => 'datetime:Y-m-d H:i:s',
    ];
}
