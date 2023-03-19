<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request):array
    {

        return [
            'coach' => $this->coach_id,
            'client_id' => $this->client_id,
            'client_name' => $this->clients->first()->name,
            'workout_start' => $this->appointment_start
        ];
    }
}
