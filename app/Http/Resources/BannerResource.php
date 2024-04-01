<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'image1'     => $this->image1,
            'image2'      => $this->image2,
            'image3'   => $this->image3,
            'short_description'   => $this->short_description,
            'title'   => $this->title,
            'button'   => $this->button,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];

    }
}
