<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    public function __invoke(File $file): JsonResponse
    {
        return new JsonResponse(['data' => [
            'id' => $file->id,
            'name' => $file->name,
            'uri' => $file->getUri(),
            'createdAt' => $file->created_at,
            'updatedAt' => $file->updated_at,
            'size' => $file->getSize(),
        ]]);
    }
}
