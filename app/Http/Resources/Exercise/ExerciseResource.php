<?php

namespace App\Http\Resources\Exercise;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name' => $this->name,
            'note' => $this->note,
            'video_src' => $this->video_src,
            'category' => $this->category->name,
            'type' => $this->types->first()->name
        ];
    }
}
