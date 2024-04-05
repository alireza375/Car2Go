<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'content_type' => $this->content_type,
            'content' => json_decode($this->content),
            'CreateAt' => $this->created_at,
            'UpdateAt' => $this->updated_at,
            '__v' => $this->key,

        ];
    }
}
