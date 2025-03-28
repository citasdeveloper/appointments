<?php

namespace App\Http\Controllers\Api;

use App\Enums\RoleName;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class AuthController extends BaseController
{
    public function signup(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', Rule::in(RoleName::values())],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'role'     => $request->role,
            'password'  => Hash::make($request->password),
        ]);
        $fullToken = $user->createToken('user-token')->plainTextToken;
        $token = explode('|', $fullToken)[1];
        return $this->sendResponse([], 'Usuario registrado correctamente.');
    }

    public function login(Request $request): JsonResponse
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->sendError('Credenciales incorrectas.', ['El email o la contraseña son incorrectos.'], 401);
        }
        $user = Auth::user();

        $fullToken = $user->createToken('MyApp')->plainTextToken;
        $token = explode('|', $fullToken)[1];
        $expiresAt = now()->addHour();
        $user->tokens()->latest()->first()->update([
            'expires_at' => $expiresAt,
        ]);
        $data = [
            'token' => $token,
            'expires_at' => $expiresAt->toDateTimeString(),
            'name' => $user->name,
            'email' => $user->email,
        ];

        return $this->sendResponse($data, 'Inicio de sesión exitoso.');
    }
}
