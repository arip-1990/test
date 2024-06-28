<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use App\Models\File;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function __invoke(?Directory $directory = null): JsonResponse
    {
        $files = $directory ? $directory->files : File::whereNull('directory_id')->get();

        return new JsonResponse(['data' => $files]);
    }
}
