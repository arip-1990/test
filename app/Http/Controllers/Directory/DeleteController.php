<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use App\UseCases\DirectoryService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    public function __construct(private readonly DirectoryService $service) {}

    public function __invoke(Directory $directory): JsonResponse
    {
        try {
            $this->service->delete($directory);
        }
        catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse();
    }
}
