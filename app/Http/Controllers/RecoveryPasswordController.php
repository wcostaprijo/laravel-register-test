<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\User\NewPasswordRequest;
use App\Http\Requests\User\RecoveryPasswordRequest;


class RecoveryPasswordController extends Controller
{
    /**
     * Retorna a view de recuperação de senha
     *
     * @return View
     */
    public function showResetForm(): View
    {
        return view('auth.passwords.email');
    }

    /**
     * Envia o email de recuperação de senha
     *
     * @param RecoveryPasswordRequest $request
     * @return JsonResponse
     */
    public function sendResetLinkEmail(RecoveryPasswordRequest $request): JsonResponse
    {
        Password::sendResetLink($request->only('email'));
        return response()->json([], 200);
    }

    /**
     * Retorna a view para criar uma nova senha
     *
     * @param string $token
     * @return View
     */
    public function showNewPasswordForm(string $token): View
    {
        return view('auth.passwords.reset')->with(['token' => $token]);
    }

    /**
     * Altera a senha do usuário
     *
     * @param NewPasswordRequest $request
     * @return JsonResponse
     */
    public function reset(NewPasswordRequest $request): JsonResponse
    {
        $status = Password::reset(
            $request->validated(),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            Auth::attempt($request->only('email', 'password'));
            $request->session()->regenerate();
            
            return response()->json(['status' => __($status)], 200);
        }

        return response()->json(['email' => [__($status)]], 422);
    }
}
