<?php

namespace App\Http\Resources;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var File $this */
        return [
            'id' => $this->id,
            'title' => $this->name,
            'url' => $this->getUri(),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
