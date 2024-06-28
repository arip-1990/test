<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\UseCases\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __construct(private readonly FileService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        $this->service->delete($request->get('files', []));

        return new JsonResponse();
    }
}
