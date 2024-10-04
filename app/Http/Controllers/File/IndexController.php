<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\UseCases\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function __construct(private readonly FileService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            return new JsonResponse([
                'data' => $this->service->getFiles($request->string('path', '/')->trim())
            ]);
        }
        catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
