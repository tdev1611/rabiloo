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
            "published_at" => $this->published_at !== null ? $this->published_at : 'Chưa có' ,
            "is_published" => $this->published_at == 1 ? 'false' : 'true',
            "category" => new CategoryResource($this->category),
            "writer" => new UserResource($this->user),
            "created_at" => $this->created_at,

        ];
    }
}
