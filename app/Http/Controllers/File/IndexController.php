<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Models\Directory;
use App\Models\File;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{
    public function __invoke(?Directory $directory = null): AnonymousResourceCollection
    {
        $files = $directory ? $directory->files : File::whereNull('directory_id')->get();

        return FileResource::collection($files);
    }
}
