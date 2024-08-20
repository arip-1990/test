<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\UseCases\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RenameController extends Controller
{
    public function __construct(private readonly FileService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->service->rename($request->get('file_id'), $request->get('name'));
        }
        catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse();
    }
}
