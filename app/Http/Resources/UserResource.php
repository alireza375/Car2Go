<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            '_id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->Name,
            'email' => $this->email,
            'phone' => $this->phone,
            // 'role' => ($this->role == USER) ? 'user' : 'admin',
            'image' => $this->image
        ];

    }
}
