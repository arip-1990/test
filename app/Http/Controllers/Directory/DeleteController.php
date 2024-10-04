<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use App\UseCases\DirectoryService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    public function __construct(private readonly DirectoryService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->service->delete($request->get('path'));
        }
        catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse();
    }
}
