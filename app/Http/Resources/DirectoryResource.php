<?php

namespace App\Http\Resources;

use App\Models\Directory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DirectoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Directory $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'path' => $this->getPath(),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}