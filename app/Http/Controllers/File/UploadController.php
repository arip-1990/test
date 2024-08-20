<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\UseCases\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends Controller
{
    public function __construct(private readonly FileService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        if (!$request->hasFile('file') or !$request->file('file')->isValid())
            return new JsonResponse();

        $files = $request->file('file');
        $this->service->store($files, $request->get('directory_id'));

        return new JsonResponse(status: Response::HTTP_CREATED);
    }
}
