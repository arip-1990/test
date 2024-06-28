<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __invoke(?Directory $directory = null): JsonResponse
    {
        $directories = $directory ? $directory->children : Directory::whereNull('parent_id')->get();

        return new JsonResponse(['data' => $directories]);
    }
}
