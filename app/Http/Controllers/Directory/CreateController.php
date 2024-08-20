<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use App\UseCases\DirectoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends Controller
{
    public function __construct(private readonly DirectoryService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->service->create($request->get('name'), Directory::find($request->get('directory_id')));
        }
        catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(status: Response::HTTP_CREATED);
    }
}
