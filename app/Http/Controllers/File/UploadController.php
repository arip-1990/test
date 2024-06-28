<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use App\UseCases\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends Controller
{
    public function __construct(private readonly FileService $service) {}

    public function __invoke(Request $request, ?Directory $directory = null): JsonResponse
    {
        if (!$request->hasFile('file') or !$request->file('file')->isValid())
            return new JsonResponse();

        $files = $request->file('file');
        $this->service->store($files, $directory);

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
