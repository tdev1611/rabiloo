<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            "title" => $this->title,
            "slug" => $this->slug,
            "image" => $this->image,
            "desc" => $this->desc,
            "published_at" => $this->published_at,
            "is_published" => $this->published_at == 1 ? 'false' : 'true',
            "category" => new CategoryResource($this->category),
            "created_at" => $this->created_at,

        ];
    }
}
