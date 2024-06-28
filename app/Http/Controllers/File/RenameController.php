<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\UseCases\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RenameController extends Controller
{
    public function __construct(private readonly FileService $service) {}

    public function __invoke(Request $request, File $file): JsonResponse
    {
        if ($request->has('newName')) $this->service->rename($file, $request->get('newName'));

        return new JsonResponse();
    }
}
