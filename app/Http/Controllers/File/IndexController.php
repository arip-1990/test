<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Http\Resources\DirectoryResource;
use App\Http\Resources\FileResource;
use App\Models\Directory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke(?Directory $directory = null): AnonymousResourceCollection
    {
        if (!$directory)
            $directory = Directory::where('name', Auth::user()->email)->first();

        return FileResource::collection([
            'directories' => DirectoryResource::collection($directory->children),
            'files' => $directory->files
        ]);
    }
}
