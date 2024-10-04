<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\UseCases\DirectoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __construct(private readonly DirectoryService $service) {}

    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->all(['name', 'email', 'password']);
        
        try {
            if (User::firstWhere('email', $credentials['email']))
                throw new \Exception('Пользователь существует');

            $user = new User([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => $credentials['password']
            ]);
            
            $this->service->create($credentials['email']);
            $user->save();
        }
        catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse();
    }
}
