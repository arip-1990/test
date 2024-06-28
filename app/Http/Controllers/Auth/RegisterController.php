<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->all(['email', 'password']);

        if (User::firstWhere('email', $credentials['email']))
            return new JsonResponse(['error' => 'Пользователь существует'], Response::HTTP_INTERNAL_SERVER_ERROR);

        User::create(['email' => $credentials['email'], 'password' => $credentials['password']]);

        return new JsonResponse();
    }
}
