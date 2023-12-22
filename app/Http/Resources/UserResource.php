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
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            // 'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'roles' => $this->when($this->roles->count() > 0, function () {
                return RoleResource::collection($this->roles);
            }, function () {
                return 'user';
            }),
            "created_at" => $this->created_at,
        ];
    }
}
