<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConcreteTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "pinned_date" => $this->created_at,
            "task" => [
                "id" => $this->task->id,
                "name" => $this->task->name,
                "description" => $this->task->description,
                "start_date" => $this->task->start_date,
                "end_date" => $this->task->end_date,
                "status" => $this->task->status,
                "priority" => $this->task->priority
            ],
            "project" => $this->task->project
        ];
    }
}
