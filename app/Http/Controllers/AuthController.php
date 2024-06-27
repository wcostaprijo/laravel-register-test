<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\StoreRequest;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    { }

    /**
     * Retorna a view de cadastro
     *
     * @return View
     */
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    /**
     * Cadastra um novo usuário
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function register(StoreRequest $request): JsonResponse
    {
        return response()->json(new UserResource($this->userService->store($request)), 201);
    }

    /**
     * Retorna a view para entrar
     *
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Realiza o login do usuário
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            return response()->json(['success' => true], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}

