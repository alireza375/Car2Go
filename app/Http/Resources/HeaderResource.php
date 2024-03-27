<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeaderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            '_id'        => $this->id,
            'logo'     => $this->logo,
            'link'      => $this->link,
            'navber'   => $this->navber,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
