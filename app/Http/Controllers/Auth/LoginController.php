<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->all(['email', 'password']);

        if (!Auth::attempt($credentials))
            return new JsonResponse(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);

        return new JsonResponse();
    }
}
